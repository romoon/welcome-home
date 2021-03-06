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
        $url = 'https://notify-api.line.me/api/notify';
        // $token = config('app.line_token');
        $token = \Auth::user()->linetoken;
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

        $lati = $request->lati;
        $long = $request->long;

        $iframeurl = 'https://maps.google.com/maps?output=embed&q=' . $lati . ',' . $long . '&t=m&hl=ja&z=15';

        return view('user.search' , [ 'iframeurl' => $iframeurl]);
    }

    public function getsearch()
    {
      $iframeurl = 'https://maps.google.com/maps?output=embed&q=東京駅';
      // https://maps.google.com/maps?output=embed&q=35.6812362,139.7671248&t=m&hl=ja&z=15

      return view('user.search' , [ 'iframeurl' => $iframeurl]);
    }
}
