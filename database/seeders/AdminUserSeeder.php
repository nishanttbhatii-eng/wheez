<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'name' => 'Admin',
                'email' => 'admin@lms_london.com',
                'password' => 'admin123',
            ],
            [
                'name' => 'Nishant',
                'email' => 'nishant@isglobalweb.com',
                'password' => 'admin123',
            ],
        ];

        foreach ($admins as $admin) {
            $user = User::firstOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'role' => 'admin',
                    'email_verified_at' => now(),
                ]
            );

            if ($user->wasRecentlyCreated) {
                $this->command->info("Admin user created: {$admin['email']}");
            } else {
                $this->command->info("Admin user already exists: {$admin['email']}");
            }
        }
    }
}
