<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RegisterUserRequest;
use App\User;
use App\Conference;
// use App\Http\Requests;

class AdminsUserController extends Controller
{
  protected $viewData    = [];
  protected $currentConf = null;

  public function __construct()
  {
    $this->middleware('auth');
    parent::__construct();
    $this->checkAllowed();
  }

  public function showNewUserForm()
  {
    // return view('admins.conferences.new');
  }

  public function showSingleUser($userId)
  {
    // $this->viewData['conf'] = $this->getConf($confUrl);
    // $this->viewData['conf'] = $confUrl;

    // dd($this->viewData['conf']->start_submit->format('Y-m-d'));

    // return view('admins.conferences.edit', $this->viewData);

  }

  public function showAllUsers()
  {
    // dd('im showing all users');
    // $this->viewData['confs'] = Conference::all();

    return view('admins.users.all');
  }

  public function storeNewUser(RegisterUserRequest $request)
  {
    // flash()->success('Create New Conference Success');

    // return redirect()->back();
  }

  public function updateConference(StoreConferenceRequest $request, Conference $confUrl)
  {
    // $confUrl->update($request->all());
    // flash()->success('Conferece Succesfully Updated');

    // return redirect()->back();
  }

  protected function checkAllowed() {
    if ($this->user === null || !$this->user->isAdmin()) {
      abort(404);
    }
  }
}
