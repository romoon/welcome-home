<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeoSearchController extends Controller
{
    public function input() {
      return view('user.input');
    }

    public function search(Request $request)
    {
      $address = $request->keyword;
      $api_key = config('app.geo_key');
      // dd($api_key);
      $address = urlencode($address);

      $url = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $address . "+CA&key=" . $api_key ;
      // dd($url);

      $contents= file_get_contents($url);
      $jsonData = json_decode($contents,true);
      dd($jsonData);
      $lat = $jsonData["results"][0]["geometry"]["location"]["lat"];
      $lng = $jsonData["results"][0]["geometry"]["location"]["lng"];

      return redirect('user/result',['lat' => $lat, 'lng' => $lng]);
    }
}
