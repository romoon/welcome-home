<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $email = $request->email;
        if ($email != '') {
            $users = User::where('name', 'like', '%'.$email.'%')
            ->orwhere('nickname', 'like', '%'.$email.'%')
            ->orwhere('email', 'like', '%'.$email.'%')
            ->get();
        } else {
            $users = User::all();
        }
        return view('admin.index', ['users' => $users, 'email' => $email]);
    }

    public function delete(Request $request)
    {
      $user = User::find($request->id);
      $user->delete();

      return redirect('admin/index');
    }
}
