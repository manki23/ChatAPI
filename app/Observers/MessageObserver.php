<?php

namespace App\Observers;

use App\Models\Message;
use Exception;
use Twilio\Rest\Client;

class MessageObserver
{
    public function created(Message $message)
    {
        $receiverNumber = getenv("TWILIO_TO");
        // to limit the size of one sms to 160 characters (Twilio add 39 characters)
        $smsText = substr($message->text, 0, 122);

        try {
            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create(
                $receiverNumber,
                [
                    'from' => $twilio_number,
                    'body' => $smsText
                ]
            );
        } catch (Exception $e) {
            dump("Error: " . $e->getMessage());
        }
    }
}
