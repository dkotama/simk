<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
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
    dd(User::findOrFail($userId)->first_name);
    // $this->viewData['conf'] = $this->getConf($confUrl);
    // $this->viewData['conf'] = $confUrl;

    // dd($this->viewData['conf']->start_submit->format('Y-m-d'));

    // return view('admins.conferences.edit', $this->viewData);

  }

  public function showAllUsers()
  {
    // dd('im showing all users');
    $paginator = User::where('deleted_at', '=', NULL)->paginate(10);

    $this->viewData['confs'] = Conference::all();
    $this->viewData['users'] = $paginator;
    $this->viewData['showAction'] = true;
    $this->viewData['showRoute'] = 'admin.user.show';
    $this->viewData['editRoute'] = 'admin.user.show';
    $this->viewData['deleteRoute'] = 'admin.user.show';
    // lanjutin nge link ke add, edit , update, delete

    return view('admins.users.all', $this->viewData);
  }

  public function showConferenceUsers(Conference $confUrl)
  {
    $page = 1;
    $per_page = 10;

    if (isset($_GET['page'])) {
      $page = $_GET['page'];
    }


    $reviewers = $confUrl->reviewers;
    $reviewers = $reviewers->toBase();

    $organizers = $confUrl->organizers;
    $organizers = $organizers->toBase();

    $authors   = $confUrl->authors;
    $authors = $authors->toBase();
    //
    $allUsers = $reviewers->merge($organizers)->merge($authors)->unique();

    $paginator = new LengthAwarePaginator($allUsers->forPage($page, $per_page), $allUsers->count(), $per_page, $page);
    $paginator->setPath($confUrl->url);
    // __construct(mixed $items, int $total, int $perPage, int|null $currentPage = null, array $options = array())

    $this->viewData['confs'] = Conference::all();
    $this->viewData['conf'] = $confUrl;
    $this->viewData['users'] = $paginator;
    $this->viewData['showAction'] = true;
    $this->viewData['showRoute'] = 'admin.user.show';
    $this->viewData['editRoute'] = 'admin.user.show';
    $this->viewData['deleteRoute'] = 'admin.user.show';

    return view('admins.users.allperconf', $this->viewData);
  }

  public function refreshUsers(Request $request)
  {
    // dd($confUrl->name);
    // $this->viewData['confs'] = Conference::all();
    //
    return redirect()->route('admin.user.conf', ['confUrl' => $request->url]);
    // return view('admins.users.all', $this->viewData);
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
