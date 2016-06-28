<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Conference;

class ConferencesController extends Controller
{
  protected $conf = null;

  protected $isAuthor    = false;
  protected $isReviewer  = false;
  protected $isOrganizer = false;
  protected $isAdmin     = false;

  protected $viewData = [];

  public function __construct() {
    $this->middleware('auth', ['except' => ['all', 'show']]);
    // var $_url  = Route::current()->getParameter('confUrl');
    // dd($route->input('confUrl');

    // var $_temp = Conference::where('url', '=', $confUrl)->firstOrFail();

    parent::__construct();
  }

  public function all()
  {
    $confs = Conference::all();
    return view('conferences.all', ['confs' => $confs]);
  }

  public function show(Conference $confUrl)
  {
    $this->setConf($confUrl);

    if (!empty($this->conf)) {
      return view('conferences.shows.home', ['conf' => $this->conf]);
    } else {
      return redirect('/');
    }
  }

  public function dashboard(Conference $confUrl)
  {
    $this->setConf($confUrl);

    if (!empty($this->conf) && $this->isAllowed()) {
      return view('conferences.dashboard', $this->viewData);
    } else {
      abort(404);
    }
  }

  protected function setConf(Conference $conf) {
    $this->conf = $conf;
    $this->viewData["conf"] = $this->conf;

    if(!empty($this->user)) {
      $this->setRoles();
    }
  }

  protected function setVars($confUrl) {
    if(!empty($this->user)) {
      $this->setRoles();
    }
  }

  protected function isAllowed() {
    $rule = $this->isAdmin || ($this->isAuthor || $this->isReviewer || $this->isOrganizer);

    if ($rule) {
      $this->viewData['allowed'] = true;
    } else {
      $this->viewData['allowed'] = false;
    }

    return $rule;
  }

  protected function setRoles() {
    $this->isAuthor    = $this->user->isAuthoring($this->conf);
    $this->isReviewer  = $this->user->isReviewing($this->conf);
    $this->isOrganizer = $this->user->isOrganizing($this->conf);
    $this->isAdmin     = $this->user->isAdmin();

    $this->viewData['isAuthor']    = $this->isAuthor;
    $this->viewData['isReviewer']  = $this->isReviewer;
    $this->viewData['isOrganizer'] = $this->isOrganizer;
    $this->viewData['isAdmin']     = $this->isAdmin;
  }

}
