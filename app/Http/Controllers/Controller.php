<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $user;
    protected $viewData = [];

    public function __construct()
    {
      $this->user = Auth::user();

      view()->share('signedIn', Auth::check());
      view()->share('user', $this->user);
    }

    protected function isAllowedAuthor($confUrl) {
      if ($this->user->authoring->contains('url', $confUrl->url)) {
        return true;
      } else {
        abort(404);
      }
    }

    protected function isAllowedOrganizer($confUrl) {
      if ($this->user->organizing->contains('url', $confUrl->url)) {
        return true;
      } else {
        abort(404);
      }
    }

    protected function isAllowedReviewer($confUrl) {
      if ($this->user->reviewing->contains('url', $confUrl->url)) {
        return true;
      } else {
        abort(404);
      }
    }
}
