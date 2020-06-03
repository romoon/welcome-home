<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeoSearchController extends Controller
{
    public function input() {
      return view('user.input');
    }
}
