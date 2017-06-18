<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Conference;
use App\ConferenceService;
use App\User;
use App\SuperuserRegisterService;
use App\CountryList;
use App\Http\Requests\RegisterUserRequest;
use App\ReviewQuestion;
use App\ParticipantApplication;
use Validator;
use Carbon\Carbon;

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

    $countryList = new CountryList();
    $this->viewData['countryList'] = $countryList->getList();


    return view('organizers.users.new', $this->viewData);
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
        $participants = $confUrl->participantAppl;

        $temp = $authors->merge($reviewers);
        $temp = $temp->merge($organizers);
        $temp->unique();

        $this->viewData['users'] = $temp;
        $this->viewData['participants'] = $participants;
      }

      return view('organizers.users', $this->viewData);
    } else {
      abort(404);
    }
  }

  //Participant

  public function showSingleParticipant(Conference $confUrl, $userId) {
    $this->setConf($confUrl);

    $showUser = User::findOrFail($userId);
    $participantAppl = ParticipantApplication::userid($userId)->conferenceid($confUrl->id)->first();

    $this->viewData['showUser']        = $showUser;
    $this->viewData['participantAppl'] = $participantAppl;

    $countryList = new CountryList();

    $this->viewData['userCountry'] = $countryList->getById($showUser->country);
    return view('organizers.users.singleparticipant', $this->viewData);
  }

  public function postParticipant(Conference $confUrl, $userId, Request $request) {
    // dd($request->all());

    $participantAppl = ParticipantApplication::userid($userId)->conferenceid($confUrl->id)->first();
    // $participantAppl->payment_proof = "laskdjasldja";
    // $participantAppl->save();
    // dd($participantAppl->payment_proof);

    if ($request->validation === 'REJECT') {
      $participantAppl->update(['payment_proof'=>'', 'payment_notes' => $request->payment_notes]);
    } else {
      $user = User::find($userId);
      $user->participating()->attach($confUrl->id);
      $participantAppl->update(['payment_notes' => $request->payment_notes]);
    }

    flash()->success('Validation Success');
    return redirect()->route('organizer.allUser', $confUrl->url);
  }

  // Manage Conferences
  public function showDescription(Conference $confUrl)
  {
    $this->setConf($confUrl);

    $visibleDates = $confUrl->getVisibleArray();

    $this->viewData['dates'] = $visibleDates;
    $this->viewData['boldNum'] = count($visibleDates['submission_deadline']);
    $this->viewData['startDate'] = $visibleDates->get('start_conference');

    return view('organizers.conferences.single', $this->viewData);
  }

  public function managesQuestions(Conference $confUrl)
  {
    $this->setConf($confUrl);
    $questions  = $confUrl->reviewQuestions;

    $this->viewData['questions'] = $questions;
    $this->viewData['manageSelected'] = 'question';

    return view('organizers.conferences.questions', $this->viewData);
  }
  public function manageWeb(Conference $confUrl)
  {
    $this->setConf($confUrl);
    $website = $confUrl->website;

    $this->viewData['website'] = $website;
    // $this->viewData['manageSelected'] = 'question';

    return view('organizers.conferences.manageweb', $this->viewData);
  }

  public function postManageWeb(Conference $confUrl, Request $request)
  {
    $confUrl->website->update($request->all());
    // $this->setConf($confUrl);
    // $website = $confUrl->website;
    //
    // $this->viewData['website'] = $website;
    // $this->viewData['manageSelected'] = 'question';

    flash()->success('Update Website Success');
    return redirect()->back();
    // return view('organizers.conferences.manageweb', $this->viewData);
  }

  public function editConference(Conference $confUrl)
  {
    $this->setConf($confUrl);

    $this->viewData['conf'] = $confUrl;
    $this->viewData['edited'] = $confUrl->toArray();

    return view('organizers.conferences.edit', $this->viewData);
  }

  public function updateConference(Conference $confUrl, Request $request)
  {
    $this->setConf($confUrl);
    $service = new ConferenceService();
    $update  = $service->update($confUrl, $request);

    if ($update) {
      flash()->success('Update Conference Success');
      return redirect()->route('organizer.manage.show', $confUrl->url);
    } else {
      return redirect()->back()->withErrors($update);
    }
  }
  public function showExtendConference(Conference $confUrl)
  {
      $this->viewData['conf']  = $confUrl;
      $this->viewData['dates'] = $confUrl->dates;

      $dateNow = Carbon::now();
      $dateNow->addMonth();
      $dateNow = $dateNow->toDateString();

      // autofill avoid empty database
      $this->viewData['edited']['start_conference'] = $dateNow;
      $this->viewData['edited']['end_conference']   = $dateNow;
      $this->viewData['edited']['submission_deadline'] = $dateNow;
      $this->viewData['edited']['acceptance'] = $dateNow;
      $this->viewData['edited']['camera_ready'] = $dateNow;
      $this->viewData['edited']['registration'] = $dateNow;

      return view('organizers.conferences.extends', $this->viewData);
  }

  public function postExtends(Conference $confUrl, Request $request)
  {
    $service = new ConferenceService();
    $result  = $service->postExtends($confUrl, $request);

    if ($result) {
      flash()->success('Add New Date Success!');
      return redirect()->route('organizer.manage.extends', $confUrl->url);
    } else {
      return redirect()->back()->withErrors($result);
    }
  }

  public function updateVisibility(Conference $confUrl, Request $request)
  {
    $service = new ConferenceService();
    $result  = $service->updateVisibility($confUrl, $request);

    if ($result === true) {
      flash()->success('Update Visibility Success');
      return redirect()->route('organizer.manage.extends', $confUrl->url);
    } else {
      return redirect()->back()->withErrors($result);
    }
  }


  public function updateQuestions(Conference $confUrl, Request $request)
  {
    $questions  = $confUrl->reviewQuestions;
    // dd($request);
    $questions->update($request->all());

    return redirect()->back();
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

  //Participant Section



  //End Participant Section


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
