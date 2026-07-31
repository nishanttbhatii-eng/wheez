<?php

namespace App\Services;

use App\Mail\EnquiryAdminMail;
use App\Mail\EnquiryCustomerMail;
use App\Models\BasicSetting;
use App\Models\Enquiry;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class EnquiryNotifier
{
    public function notify(Enquiry $enquiry): void
    {
        $fromAddress = BasicSetting::getValue('mail_from') ?: config('mail.from.address');
        $fromName = BasicSetting::getValue('mail_from_name') ?: (config('mail.from.name') ?: 'Whizseed');

        foreach ($this->adminRecipients() as $adminEmail) {
            try {
                Mail::to($adminEmail)->send(
                    (new EnquiryAdminMail($enquiry))->from($fromAddress, $fromName)
                );
            } catch (Throwable $e) {
                Log::error('Failed to send enquiry admin mail', [
                    'to' => $adminEmail,
                    'enquiry_id' => $enquiry->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        if (! empty($enquiry->email)) {
            try {
                Mail::to($enquiry->email)->send(
                    (new EnquiryCustomerMail($enquiry))->from($fromAddress, $fromName)
                );
            } catch (Throwable $e) {
                Log::error('Failed to send enquiry customer mail', [
                    'to' => $enquiry->email,
                    'enquiry_id' => $enquiry->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    /**
     * @return list<string>
     */
    private function adminRecipients(): array
    {
        $candidates = [
            BasicSetting::getValue('contact_us_receiving_mail'),
            BasicSetting::getValue('ADMIN-MAIL'),
            User::query()->where('is_admin', 1)->orderBy('id')->value('email'),
        ];

        $emails = [];
        foreach ($candidates as $email) {
            $email = is_string($email) ? trim($email) : '';
            if ($email === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                continue;
            }
            $emails[strtolower($email)] = $email;
        }

        return array_values($emails);
    }
}
