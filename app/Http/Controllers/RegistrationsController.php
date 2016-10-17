<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use App\ActivationService;

use App\Http\Requests\RegisterUserRequest;

// NOTE: buatin send email, dan recovery

class RegistrationsController extends Controller
{
  protected $activationService;

  public function __construct(ActivationService $activationService)
  {
    $this->activationService = $activationService;
  }

  public function showRegistrationForm()
  {
    if (!Auth::check()) {
      return view('auth.register');
    } else {
      return redirect('/users/home');
    }
  }

  // public function register(RegisterUserRequest $request)
  // {
  //   User::create($this->generateUserData($request->all()));
  //
  //   flash()->success('Registration Succesful.');
  //
  //   return redirect()->back();
  // }

  public function register(RegisterUserRequest $request) {
    // $user = $this->create($request->all());
    $user = User::create($this->generateUserData($request->all()));

    $this->activationService->sendActivationMail($user);

    return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
  }

  public function authenticated(Request $request, $user)
  {
    if (!$user->activated) {
        $this->activationService->sendActivationMail($user);
        auth()->logout();
        return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email.');
    }
    return redirect('/login');
  }

  public function activateUser($token)
  {
      if ($user = $this->activationService->activateUser($token)) {
          auth()->login($user);
          return redirect('/login');
      }
      abort(404);
  }

  protected function generateUserData(Array $arr) {
    $arr['password'] = bcrypt($arr['password']);

    return $arr;
  }
}
