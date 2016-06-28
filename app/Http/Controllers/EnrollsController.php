<?php

namespace App\Http\Controllers;

use App\Conference;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class EnrollsController extends ConferencesController
{
  public function showManagesUser(Conference $confUrl)
  {
    if ($this->isAllowed()) {
      $this->setConf($confUrl);

      $this->viewData['users'] = User::paginate(15);

      return view('conferences.users', $this->viewData);
    } else {
      abort(404);
    }
  }

  public function attachRoles(Conference $confUrl, User $user, $mode)
  {
    if ($this->isAllowed()) {
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
    if ($this->isAllowed()) {
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




  protected function isAllowed() {
    return ($this->user->isAdmin() || $this->user->organizing);
  }
}
