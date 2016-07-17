<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreConferenceRequest;
use App\User;
use App\Conference;
// use App\Http\Requests;

class AdminsController extends Controller
{

  protected $viewData = [];

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
    return view('admins.conferences.new');
  }

  public function showSingleConference(Conference $confUrl)
  {
    // $this->viewData['conf'] = $this->getConf($confUrl);
    $this->viewData['conf'] = $confUrl;

    // dd($this->viewData['conf']->start_date->format('Y-m-d'));

    return view('admins.conferences.edit', $this->viewData);
    //FIXME edit date all error, should be showing posted value first and then original value

  }

  public function showAllConferences()
  {
    $this->viewData['confs'] = Conference::all();

    return view('admins.conferences.all', $this->viewData);
  }

  public function storeNewConference(StoreConferenceRequest $request)
  {
    // dd($request->all());
    // Conference::create($request->all()); //
    flash()->success('Create New Conference Success');

    return redirect()->back();
  }

  public function updateConference(StoreConferenceRequest $request, Conference $confUrl)
  {
    $confUrl->update($request->all());
    flash()->success('Conferece Succesfully Updated');

    return redirect()->back();
  }

  protected function checkAllowed() {
    if ($this->user === null || !$this->user->isAdmin()) {
      abort(404);
    }
  }

  protected function getConf($url) {
    return Conference::where('url', $url)->first();
  }
}
