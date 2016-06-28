<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests\RegisterUserRequest;

class RegistrationsController extends Controller
{
  public function showRegistrationForm()
  {
    if (!Auth::check()) {
      return view('auth.register');
    } else {
      return redirect('/');
    }
  }

  public function register(RegisterUserRequest $request)
  {
    User::create($this->generateUserData($request->all()));

    flash()->success('Registration Succesful.');

    return redirect()->back();
  }

  protected function generateUserData(Array $arr) {
    $arr['password'] = bcrypt($arr['password']);

    return $arr;
  }
}
