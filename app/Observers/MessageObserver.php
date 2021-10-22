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
            $accountSid = getenv("TWILIO_SID");
            $authToken = getenv("TWILIO_TOKEN");
            $senderNumber = getenv("TWILIO_FROM");

            $client = new Client($accountSid, $authToken);
            $client->messages->create(
                $receiverNumber,
                [
                    'from' => $senderNumber,
                    'body' => $smsText
                ]
            );
        } catch (Exception $e) {
//            dump("Error: " . $e->getMessage());
        }
    }
}
