<?php

namespace App\Http\Controllers;

use App\Conference;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Http\Requests\StoreConferenceRequest;
// use App\Http\Requests;

class AdminsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
    parent::__construct();
    $this->checkAllowed();
  }

  public function index()
  {
    return view('admins.dashboard');
  }

  public function showNewConferenceForm()
  {
    return view('admins.conferences');
  }

  public function showSingleConference($confId)
  {
    dd($confId);
  }

  public function showAllConferences()
  {
    return view('admins.conferences.all');
  }

  public function storeNewConference(StoreConferenceRequest $request)
  {
    // dd($request->all());
    Conference::create($request->all()); //
    flash()->success('Create New Conference Success');

    return redirect()->back();
  }

  protected function checkAllowed() {
    if ($this->user === null || !$this->user->isAdmin()) {
      abort(404);
    }
  }
}
