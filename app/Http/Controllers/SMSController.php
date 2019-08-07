<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SMSClient;

class SMSController extends Controller
{
    public function getBalance() {
        $client = new SMSClient();
        $res = $client->balance();
    }

    public function sendSMS() {
        //return response()->json(request()->all());
        request()->validate([
            'sender' => 'required',
            'recipient' => 'required',
            'message' => 'required|string'
        ]);

        $client = new SMSClient();
        $recipients = explode(',', request()->recipient);

        //foreach($recipients as $recipient) {
            $res = $client->send(request()->sender, $recipients[0], request()->message);
        //}

        return $res;
        
    }
}
