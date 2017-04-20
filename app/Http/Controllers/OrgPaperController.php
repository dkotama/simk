<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Conference;
use App\Submission;
use App\SubmissionAuthor;
use App\SubmissionPaper;
use App\User;
use Validator;
use Route;
use Carbon\Carbon;

class OrgPaperController extends Controller
{
  protected $viewData = [];
  protected $conf     = NULL;

  public function __construct() {
    $this->middleware('auth');

    parent::__construct();

    $params = Route::current()->parameters();
    $this->conf = $params['confUrl'];

    //check if user authorized or not

    $this->isAllowedOrganizer($this->conf);
    $this->viewData['conf'] = $this->conf;
  }

  public function allPapers($confUrl)
  {
    // $submissions = $this->conf->submissions->all();
    $submissions = Submission::withTrashed()->where('conference_id', $confUrl->id)->get();
    $this->viewData['submissions'] = $submissions;
    // dd($this->conf->submissions);

    return view('organizers.papers.all', $this->viewData);
  }

  public function singlePaper(Conference $confUrl, $paperId)
  {
    $date = new Carbon();

    $submission = Submission::findOrFail($paperId);

    //
    $this->viewData['submission']  = $submission;
    $this->viewData['authors']     = $submission->authors->sortBy('author_no');
    $this->viewData['authorCount'] = $submission->authors->count();
    $this->viewData['reviewers']   = $submission->reviewers;

    return view('organizers.papers.single', $this->viewData);
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

  public function assignReviewer(Conference $confUrl, $paperId)
  {
    $submission = Submission::findOrFail($paperId);

    $this->viewData['reviewers'] = $confUrl->reviewers;
    $this->viewData['submission']  = $submission;

    return view('organizers.papers.assign', $this->viewData);
  }

  public function showEditUser(Conference $confUrl, $userId)
  {
    $countryList = new CountryList();
    $this->viewData['countryList'] = $countryList->getList();

    $this->setConf($confUrl);
    $this->viewData['editedUser'] = User::findOrFail($userId);
    // dd($this->viewData['editedUser']);

    return view('organizers.users.edit', $this->viewData);
  }

  public function updateUser(Request $request, Conference $confUrl, $userId)
  {
    $this->setConf($confUrl);

    $editedUser = User::findOrFail($userId);
    //
    $rules = [
      'salutation' => 'required',
      'first_name' => 'required',
      'last_name' => 'required',
      'status' => 'required',
      'country' => 'required'
    ];
    //
    $userData = $request->all();

    if ($editedUser->email !== $userData['email'] && $userData['email'] !== "") {
      $rules['email'] = 'email|unique:users';
    } else {
      unset($userData['email']);
    }

    if ($userData['password'] === '') {
      unset($userData['password']);
      unset($userData['password_confirmation']);
    } else {
      $rules['password'] = 'required|confirmed';
    }

    $validator = Validator::make($request->all(), $rules);
    //
    if ($validator->fails()) {
      return redirect()
            ->route('organizer.editUser', ['confUrl' => $confUrl->url, 'userId' => $editedUser->id])
            ->withErrors($validator)
            ->withInput();
    }

    $countryList = new CountryList();
    $this->viewData['countryList'] = $countryList->getList();

    if (isset($userData['password'])) {
      $userData['password'] = bcrypt($userData['password']);
    }


    $update = $editedUser->update($userData);
    //
    if ($update) {
      flash()->success('Success register user');
    }
    //
    $this->viewData['editedUser'] = $editedUser;
    //
    return view('organizers.users.edit', $this->viewData);
  }

  public function registerUser(RegisterUserRequest $request, Conference $confUrl)
  {
    $userData = $request->all();
    $register = new SuperuserRegisterService();
    $user = $register->create($userData, $confUrl->id);

    if ($user) {
      flash()->success('Success register user');
    }

    return redirect()->route('organizer.allUser', ['conf' => $confUrl->url]);
  }

  public function showManagesUser(Conference $confUrl, $mode = null)
  {
    if ($this->isAllowed($confUrl)) {
      $this->viewData['userSelected'] = 'registered';

      $this->setConf($confUrl);
      $temp = collect([]);

      if (isset($mode) && $mode === 'nonregistered') {
        $this->viewData['userSelected'] = 'nonregistered';
        $users = User::all();
        $users->keyBy('id');


        foreach ($users as $usr) {
          if (!$usr->isAdmin() && !$usr->isAuthoring($confUrl) && !$usr->isReviewing($confUrl) && !$usr->isOrganizing($confUrl)) {

            $temp->prepend($usr);
          }
        }

        $this->viewData['users'] = $temp;
      } else {
        $authors    = $confUrl->authors;
        $reviewers  = $confUrl->reviewers;
        $organizers = $confUrl->organizers;

        $temp = $authors->merge($reviewers);
        $temp = $temp->merge($organizers);
        $temp->unique();

        $this->viewData['users'] = $temp;
      }

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
    return ($this->user->isAdmin() || $this->user->isOrganizing($confUrl));
  }

  protected function setConf(Conference $confUrl) {
    if ($this->isAllowed($confUrl)) {
      $this->viewData['conf'] = $confUrl;
    } else {
      abort(404);
    }
  }
}
