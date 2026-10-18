<?php

namespace App\Support;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Throwable;

class FoundationNotifier
{
    public static function send(?string $recipient, string $subject, string $body): bool
    {
        if (!$recipient || !filter_var($recipient, FILTER_VALIDATE_EMAIL)) {
            Log::notice('Foundation email skipped: recipient is not configured.', ['subject' => $subject]);
            return false;
        }

        try {
            Mail::raw($body, function ($message) use ($recipient, $subject) {
                $message->to($recipient)->subject($subject);
            });
            return true;
        } catch (Throwable $exception) {
            Log::warning('Foundation email delivery failed.', [
                'recipient' => $recipient,
                'subject' => $subject,
                'error' => $exception->getMessage(),
            ]);
            return false;
        }
    }

    public static function notifyTeam(string $subject, string $body): bool
    {
        $recipient = env('FOUNDATION_NOTIFICATION_EMAIL');
        try {
            if (DB::getSchemaBuilder()->hasTable('foundation_settings')) {
                $configured = DB::table('foundation_settings')->where('key', 'notification_email')->value('value');
                if (is_string($configured) && trim($configured) !== '') {
                    $recipient = trim($configured);
                }
            }
        } catch (Throwable $exception) {
            Log::notice('Foundation notification setting could not be read.', ['error' => $exception->getMessage()]);
        }

        return self::send($recipient, $subject, $body);
    }
}
