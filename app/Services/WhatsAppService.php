<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send a WhatsApp message using UltraMsg.
     *
     * @param string $to Recipient's phone number
     * @param string $body Text message body
     * @return bool
     */
    public static function sendMessage(string $to, string $body): bool
    {
        $token = config('services.ultramsg.token');
        $instanceId = config('services.ultramsg.instance_id');

        // If credentials are not configured, log a warning and skip
        if (!$token || !$instanceId) {
            Log::warning('UltraMsg credentials not configured in services configuration.');
            return false;
        }

        // Clean up the recipient's phone number to retain only digits (and + sign if exists)
        $cleanPhone = preg_replace('/[^0-9+]/', '', $to);

        try {
            $response = Http::asForm()->post("https://api.ultramsg.com/{$instanceId}/messages/chat", [
                'token' => $token,
                'to'    => $cleanPhone,
                'body'  => $body,
            ]);

            if ($response->successful()) {
                Log::info("WhatsApp successfully sent to {$cleanPhone} via UltraMsg.");
                return true;
            }

            Log::error("Failed to send WhatsApp via UltraMsg to {$cleanPhone}. Response: " . $response->body());
            return false;
        } catch (\Exception $e) {
            Log::error("Exception encountered when calling UltraMsg for {$cleanPhone}: " . $e->getMessage());
            return false;
        }
    }
}
