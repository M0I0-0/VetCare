<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send a WhatsApp message using Green-API.
     *
     * @param string $to Recipient's phone number
     * @param string $body Text message body
     * @return bool
     */
    public static function sendMessage(string $to, string $body): bool
    {
        $token = config('services.greenapi.token');
        $instanceId = config('services.greenapi.instance_id');

        // If credentials are not configured, log a warning and skip
        if (!$token || !$instanceId) {
            Log::warning('Green-API credentials not configured in services configuration.');
            return false;
        }

        // Clean up the recipient's phone number to retain only digits
        $cleanPhone = preg_replace('/[^0-9]/', '', $to);

        // Format Mexican numbers for WhatsApp/Green-API (requires '521' for mobile numbers)
        if (str_starts_with($cleanPhone, '52') && !str_starts_with($cleanPhone, '521')) {
            // If it starts with '52' but not '521' (e.g. 5299993787874), insert '1' after '52'
            $cleanPhone = '521' . substr($cleanPhone, 2);
        } elseif (!str_starts_with($cleanPhone, '52') && (strlen($cleanPhone) === 10 || strlen($cleanPhone) === 11)) {
            // If it's a 10 or 11 digit local number (e.g. 9999378787 or 99993787874), assume Mexico and prepend '521'
            $cleanPhone = '521' . $cleanPhone;
        }

        try {
            $response = Http::post("https://api.green-api.com/waInstance{$instanceId}/sendMessage/{$token}", [
                'chatId'  => "{$cleanPhone}@c.us",
                'message' => $body,
            ]);

            if ($response->successful()) {
                Log::info("WhatsApp successfully sent to {$cleanPhone} via Green-API.");
                return true;
            }

            Log::error("Failed to send WhatsApp via Green-API to {$cleanPhone}. Response: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("Exception encountered when calling Green-API for {$cleanPhone}: " . $e->getMessage());
            return false;
        }
    }
}
