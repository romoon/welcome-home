<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class ProfileController extends Controller
{
  public function edit(Request $request)
  {
      $profile = \Auth::user();

      return view('user.profile.edit', ['profile_form' => $profile]);
  }

  public function update(Request $request)
  {
    $this->validate($request, \Auth::user()::$rules);

    $profile = \Auth::user();

    $profile_form = $request->all();

    unset($profile_form['_token']);

    $profile->fill($profile_form)->save();

    return redirect('search');
  }
}
