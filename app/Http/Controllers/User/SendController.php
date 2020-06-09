<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class SendController extends Controller
{

    public function sendnotify(Request $request)
    {
        $url = $request->notifyurl;
        // $url = 'https://notify-api.line.me/api/notify';
        // dd($url);
        // $token = $request->token;
        $token = config('app.line_token');
        $message = $request->smessage;
        $client = new Client();

        $client->post($url, [
            'headers' => [
                'Content-Type'  => 'application/x-www-form-urlencoded',
                'Authorization' => "Bearer " . $token,
            ],
            'form_params' => [
                'message' => "$message",
            ]
        ]);

        return view('user.result');
    }
}
