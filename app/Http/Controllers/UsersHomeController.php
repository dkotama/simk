<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conference;
use App\Http\Requests;

class UsersHomeController extends Controller
{
  protected $viewData = [];

  public function home(Conference $confUrl)
  {
   $this->setInit($confUrl, 'home');

   return view('conferences.shows.home', $this->viewData);
  }

  public function callPaper(Conference $confUrl)
  {
   $this->setInit($confUrl, 'callpaper');

   return view('conferences.shows.callpaper', $this->viewData);
  }

  public function policies(Conference $confUrl)
  {
    $this->setInit($confUrl, 'policies');

   return view('conferences.shows.policies', $this->viewData);
  }

  protected function setInit($conf, $active) {
    $this->viewData['conf'] = $conf;
    $this->canAccessDasboard($conf);
    $this->setActive($active);
  }

  protected function setActive($string)
  {
    $this->viewData['active'] = $string;
  }

  protected function canAccessDasboard($conf)
  {
    if (isset($this->user) &&
       ($this->user->isAdmin() ||
        $this->user->isAuthoring($conf) ||
        $this->user->isReviewing($conf) ||
        $this->user->isOrganizing($conf))) {
      $this->viewData['allowed'] = true;
    } else {
      $this->viewData['allowed'] = false;
    }
  }
}
