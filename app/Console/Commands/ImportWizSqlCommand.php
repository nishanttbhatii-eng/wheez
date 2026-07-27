<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportWizSqlCommand extends Command
{
    protected $signature = 'wiz:import-sql
        {--path= : Absolute path to the SQL dump}
        {--tables= : Comma-separated tables to import (default: all CMS tables)}';

    protected $description = 'Import CMS tables from the Whizseed SQL dump (skips pages/users)';

    private const TABLES = [
        'basic_settings',
        'categories',
        'states',
        'cities',
        'services',
        'enquiries',
        'leads',
        'seos',
    ];

    public function handle(): int
    {
        $path = $this->option('path') ?: '/home/nishant-bhati/Downloads/u440824249_wiz.sql';

        if (! is_readable($path)) {
            $this->error("SQL dump not readable: {$path}");

            return self::FAILURE;
        }

        $tables = self::TABLES;
        if ($this->option('tables')) {
            $tables = array_values(array_filter(array_map('trim', explode(',', $this->option('tables')))));
        }

        foreach ($tables as $table) {
            if (! Schema::hasTable($table)) {
                $this->error("Table missing: {$table}. Run migrations first.");

                return self::FAILURE;
            }
        }

        $this->info('Extracting INSERT statements from dump...');
        $filteredPath = storage_path('app/wiz-import-filtered.sql');
        $counts = $this->extractInserts($path, $filteredPath, $tables);

        foreach ($tables as $table) {
            $this->line("  {$table}: {$counts[$table]} statement(s)");
        }

        if (array_sum($counts) === 0) {
            $this->error('No INSERT statements found for selected tables.');

            return self::FAILURE;
        }

        $this->info('Truncating and importing...');
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::statement("SET sql_mode = ''");

        try {
            foreach ($tables as $table) {
                DB::table($table)->truncate();
            }

            $handle = fopen($filteredPath, 'rb');
            $buffer = '';
            $executed = 0;
            $failed = 0;
            $marker = "\n--WIZ_STMT_END--\n";

            while (! feof($handle)) {
                $chunk = fread($handle, 2 * 1024 * 1024);
                if ($chunk === false || $chunk === '') {
                    break;
                }
                $buffer .= $chunk;

                while (($pos = strpos($buffer, $marker)) !== false) {
                    $stmt = trim(substr($buffer, 0, $pos));
                    $buffer = substr($buffer, $pos + strlen($marker));

                    if ($stmt === '' || ! str_starts_with($stmt, 'INSERT INTO')) {
                        continue;
                    }

                    $stmt = str_replace("'0000-00-00 00:00:00'", 'NULL', $stmt);
                    if (! str_ends_with($stmt, ';')) {
                        $stmt .= ';';
                    }

                    try {
                        DB::unprepared($stmt);
                        $executed++;
                        if ($executed % 250 === 0) {
                            $this->line("  ... {$executed} statements");
                        }
                    } catch (\Throwable $e) {
                        $failed++;
                        if ($failed <= 10) {
                            $this->line('  Skip: ' . substr($e->getMessage(), 0, 140));
                        }
                    }
                }
            }

            fclose($handle);
            $this->info("Executed {$executed} statements ({$failed} failed).");
        } finally {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }

        @unlink($filteredPath);

        $this->newLine();
        $this->info('Import complete:');
        foreach ($tables as $table) {
            $this->line(sprintf('  %-18s %d rows', $table, DB::table($table)->count()));
        }

        return self::SUCCESS;
    }

    /**
     * Walk the dump byte-by-byte and write only INSERT statements for allowed tables.
     * Respects quoted strings so HTML content with semicolons does not break statements.
     *
     * @param  array<int, string>  $tables
     * @return array<string, int>
     */
    private function extractInserts(string $sourcePath, string $targetPath, array $tables): array
    {
        $counts = array_fill_keys($tables, 0);
        $needles = [];
        foreach ($tables as $table) {
            $needles['INSERT INTO `' . $table . '`'] = $table;
        }

        $in = fopen($sourcePath, 'rb');
        $out = fopen($targetPath, 'wb');
        if ($in === false || $out === false) {
            throw new \RuntimeException('Unable to open dump files for extraction.');
        }

        $carry = '';
        $capturing = false;
        $currentTable = null;
        $inString = false;
        $stringChar = '';
        $escape = false;
        $statement = '';

        while (! feof($in)) {
            $chunk = fread($in, 1024 * 1024);
            if ($chunk === false || $chunk === '') {
                break;
            }

            $data = $carry . $chunk;
            $carry = '';
            $offset = 0;
            $length = strlen($data);

            while ($offset < $length) {
                if (! $capturing) {
                    $foundAt = null;
                    $foundTable = null;
                    $foundNeedle = null;
                    foreach ($needles as $needle => $table) {
                        $pos = stripos($data, $needle, $offset);
                        if ($pos === false) {
                            continue;
                        }
                        if ($foundAt === null || $pos < $foundAt) {
                            $foundAt = $pos;
                            $foundTable = $table;
                            $foundNeedle = $needle;
                        }
                    }

                    if ($foundAt === null) {
                        // Keep tail that might contain partial needle.
                        $maxNeedle = max(array_map('strlen', array_keys($needles)));
                        $carry = substr($data, max($offset, $length - $maxNeedle));
                        break;
                    }

                    $capturing = true;
                    $currentTable = $foundTable;
                    $statement = substr($data, $foundAt, strlen($foundNeedle));
                    $offset = $foundAt + strlen($foundNeedle);
                    $inString = false;
                    $escape = false;
                    continue;
                }

                $ch = $data[$offset];

                if ($inString) {
                    $statement .= $ch;
                    if ($escape) {
                        $escape = false;
                    } elseif ($ch === '\\') {
                        $escape = true;
                    } elseif ($ch === $stringChar) {
                        if ($offset + 1 < $length && $data[$offset + 1] === $stringChar) {
                            $statement .= $data[$offset + 1];
                            $offset += 2;
                            continue;
                        }
                        $inString = false;
                    }
                    $offset++;
                    continue;
                }

                if ($ch === "'" || $ch === '"') {
                    $inString = true;
                    $stringChar = $ch;
                    $statement .= $ch;
                    $offset++;
                    continue;
                }

                $statement .= $ch;
                $offset++;

                if ($ch === ';') {
                    fwrite($out, $statement . "\n--WIZ_STMT_END--\n");
                    $counts[$currentTable]++;
                    $capturing = false;
                    $currentTable = null;
                    $statement = '';
                }
            }
        }

        fclose($in);
        fclose($out);

        return $counts;
    }
}
