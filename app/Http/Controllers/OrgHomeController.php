<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Conference;
use App\User;
use App\SuperuserRegisterService;

use App\Http\Requests\RegisterUserRequest;

class OrgHomeController extends Controller
{
  protected $viewData = [];

  public function __construct() {
    $this->middleware('auth');
    // var $_url  = Route::current()->getParameter('confUrl');
    // dd($route->input('confUrl');

    // var $_temp = Conference::where('url', '=', $confUrl)->firstOrFail();

    parent::__construct();
  }

  public function dashboard(Conference $confUrl)
  {
    $this->setConf($confUrl);

    if ($this->isAllowed($confUrl)) {
      return view('organizers.dashboard', $this->viewData);
    } else {
      abort(404);
    }
  }

  public function showAddUser(Conference $confUrl)
  {
    $this->setConf($confUrl);

    return view('organizers.users.new', $this->viewData);
  }

  public function showEditUser(Conference $confUrl, $userId)
  {
    $this->setConf($confUrl);
    $this->viewData['editedUser'] = User::findOrFail($userId);
    // dd($this->viewData['editedUser']->first_name);

    return view('organizers.users.edit', $this->viewData);
  }

  public function updateUser(RegisterUserRequest $request, Conference $confUrl)
  {
    dd($request->all());
    // $this->setConf($confUrl);

    return redirect()->route('organizer.allUser', ['conf' => $confUrl->url]);
    // return view('organizers.users.edit', $this->viewData);
  }

  public function registerUser(RegisterUserRequest $request, Conference $confUrl)
  {
    $userData = $request->all();
    $register = new SuperuserRegisterService();
    $user = $register->create($userData, $confUrl->id);

    return redirect()->route('organizer.allUser', ['conf' => $confUrl->url]);
  }

  public function showManagesUser(Conference $confUrl)
  {
    if ($this->isAllowed($confUrl)) {
      $this->setConf($confUrl);

      $this->viewData['users'] = User::paginate(15);

      return view('organizers.users', $this->viewData);
    } else {
      abort(404);
    }
  }

  public function attachRoles(Conference $confUrl, User $user, $mode)
  {
    if ($this->isAllowed($confUrl)) {
      // dd($mode);
      if ($mode === 'author') {
        $user->authoring()->attach($confUrl->id);
      } else if ($mode === 'reviewer') {
        $user->reviewing()->attach($confUrl->id);
      } else if ($mode === 'organizer'){
        $user->organizing()->attach($confUrl->id);
      } else if ($mode === 'admin'){
        $user->is_admin = true;
        $user->save();
      } else {
        abort(404);
      }

      if ($mode !== 'admin') {
        flash()->success($user->last_name . ' is now ' . $mode . ' of ' . $confUrl->name);
      } else {
        flash()->success($user->last_name . ' is now an Administrator of SIMK');
      }

      return redirect()->back();
    } else {
      abort(404);
    }
  }

  public function detachRoles(Conference $confUrl, User $user, $mode)
  {
    if ($this->isAllowed($confUrl)) {
      if ($mode === 'author') {
        $user->authoring()->detach($confUrl->id);
      } else if ($mode === 'reviewer') {
        $user->reviewing()->detach($confUrl->id);
      } else if ($mode === 'organizer'){
        $user->organizing()->detach($confUrl->id);
      } else if ($mode === 'admin'){
        $user->is_admin = false;
        $user->save();
      } else {
        abort(404);
      }

      if ($mode !== 'admin') {
        flash()->success($user->last_name . ' is no longer ' . $mode . ' of ' . $confUrl->name);
      } else {
        flash()->success($user->last_name . ' is no longer an Administrator of SIMK');
      }
      return redirect()->back();
    } else {
      abort(404);
    }
  }

  protected function isAllowed(Conference $confUrl) {
    return ($this->user->isAdmin() || $this->user->isAuthoring($confUrl));
  }

  protected function setConf(Conference $confUrl) {
    if ($this->isAllowed($confUrl)) {
      $this->viewData['conf'] = $confUrl;
    } else {
      abort(404);
    }
  }
}
