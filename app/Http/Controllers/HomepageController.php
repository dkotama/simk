<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conference;
use App\Website;
use App\Http\Requests;
use App\Http\Request\SubmitPaperRequest;

class HomepageController extends Controller
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
    $this->viewData['website'] = $confUrl->website;

   return view('conferences.shows.policies', $this->viewData);
  }

  public function helpParticipant(Conference $confUrl)
  {
    $this->setInit($confUrl, 'helpp');
    $this->viewData['website'] = $confUrl->website;

   return view('conferences.shows.helpparticipant', $this->viewData);
  }

  public function helpAuthor(Conference $confUrl)
  {
    $this->setInit($confUrl, 'helpa');
    $this->viewData['website'] = $confUrl->website;

   return view('conferences.shows.helpauthor', $this->viewData);
  }
  protected function setInit($conf, $active) {
    $this->viewData['conf'] = $conf;
    $this->canAccessDasboard($conf);
    $this->setActive($active);

    if (isset($this->user)) {
      if ($this->user->isAuthoring($conf)) {
        $this->viewData['joinUrl']  = route('user.home.manage', $conf->url);
        $this->viewData['joinText'] = 'Manage Submission';
      } else {
        $this->viewData['joinUrl']  = route('user.join.conf', $conf->url);
        $this->viewData['joinText'] = 'Join Now';
      }
    } else {
      $this->viewData['joinUrl']  = '/register';
      $this->viewData['joinText'] = 'Login / Register To Join';
    }

    //new config
    $this->viewData['website'] = $conf->website;

    $visibleDates = $conf->getVisibleArray();

    $this->viewData['dates'] = $visibleDates;
    $this->viewData['boldNum'] = count($visibleDates['submission_deadline']);
    $this->viewData['startDate'] = $visibleDates->get('start_conference');
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
