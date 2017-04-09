<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\SubmitPaperRequest;
use App\User;
use App\Conference;
use App\Submission;
use App\SubmissionAuthor;
use App\SubmissionPaper;
use Illuminate\Support\Facades\Input;
use Validator;
use App\CountryList;
use App\RoleWriter;
// use App\Http\Requests;

class UsersHomeController extends Controller
{
  protected $viewData = [];
  protected $uploadFolder = 'uploads';

  public function __construct()
  {
    $this->middleware('auth');
    parent::__construct();

    $authoring = $this->user->authoring()->get();
    $reviewing = $this->user->reviewing()->get();
    $organizing = $this->user->organizing()->get();

    $this->viewData['authoring'] = $authoring;
    $this->viewData['reviewing'] = $reviewing;
    $this->viewData['organizing'] = $organizing;

    $this->viewData['isAdmin'] = $this->user->isAdmin();
  }

  public function addPaper(Conference $confUrl)
  {
    $this->viewData['conf'] = $confUrl;

    return view('users.home.add', $this->viewData);
  }

  public function manage(Conference $confUrl)
  {
    $this->isAllowedAuthor($confUrl);

    $this->viewData['conf'] = $confUrl;
    $this->viewData['submissions'] = $this->user->submissions->where('conference_id', $confUrl->id)->all();

    return view('users.home.manage', $this->viewData);
  }

  public function join(Conference $confUrl)
  {
    if (!$this->user->authoring->contains('url', $confUrl->url)) {
      $this->viewData['conf'] = $confUrl;

      $writer = new RoleWriter($confUrl, $this->user, 'author');

      $writer->attach();
    }

    return redirect()->route('user.home.manage', ['confUrl' => $confUrl->url]);
    // return view('welcome');
  }

  public function submitPaper(Request $request, Conference $confUrl) {
    $this->isAllowedAuthor($confUrl);

    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'abstract' => 'required',
      'keywords' => 'required',
      'paper' => 'required|mimes:pdf|max:5000'
    ]);

    if ($validator->fails()) {
      return redirect()
      ->back()
      ->withErrors($validator)
      ->withInput();
    }


    $submission = Submission::create($request->all());

    $this->user->submissions()->save($submission);
    $confUrl->submissions()->save($submission);

    $submissionPaper = SubmissionPaper::create(['version' => 1]);
    $submission->versions()->save($submissionPaper);

    $submission->update(['active_version' => $submissionPaper->version]);

    $paper = $request->file('paper');

    if ($paper->isValid()) {
        $extension = $paper->getClientOriginalExtension(); // getting image extension
        $fileName = md5(uniqid('', true) . microtime()) . '.' . $extension; // renaming image
        $paper->move($this->uploadFolder, $fileName); // uploading file to given path
        $submissionPaper->path = $fileName;
        $submissionPaper->save();
    } else {
    }

    return redirect()->route('user.home.single.show', ['conf' => $confUrl->url, 'paperId' => $submission->id]);
  }

  public function showSinglePaper(Conference $confUrl, $paperId)
  {
    $this->isAllowedAuthor($confUrl);

    $submission = Submission::findOrFail($paperId);

    $this->viewData['conf']        = $confUrl;
    $this->viewData['submission']  = $submission;
    $this->viewData['authors']     = $submission->authors->sortBy('author_no');
    $this->viewData['authorCount'] = $submission->authors->count();

    return view('users.home.single', $this->viewData);
  }

  public function addAuthor(Conference $confUrl, Request $request, $paperId)
  {
    $this->isAllowedAuthor($confUrl);
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required'
    ]);

    if ($validator->fails()) {
      return redirect()
      ->back()
      ->withErrors($validator)
      ->withInput();
    }

    $author = SubmissionAuthor::create($request->all());
    $submission = Submission::findOrFail($paperId);

    $author->author_no = $submission->authors->count() + 1;

    if ($submission->authors->count() === 0) {
      $author->is_primary = 1;
    }

    $submission->authors()->save($author);

    return redirect()->back();
  }

  public function cancelPaper($confUrl, $paperId)
  {
    $this->isAllowedAuthor($confUrl);

    $submission = submission::findOrFail($paperId);
    
    dd($submission);

    //2.tambahin deleted_at
    //3. jangan lupa update di see all papers

    // return redirect()->route('user.home.single.show', ['conf' => $confUrl->url, 'paperId' => $paperId]);
  }

  public function moveAuthor(Conference $confUrl, Request $request, $paperId, $from, $to)
  {
    $this->isAllowedAuthor($confUrl);
    $submission = Submission::findOrFail($paperId);
    $authors = $submission->authors;

    $fromNum = $authors->where('author_no', intval($from))->first();
    $toNum = $authors->where('author_no', intval($to))->first();

    if (!is_null($fromNum) && !is_null($toNum)) {
      $fromNum->update(['author_no' => $to]);
      $toNum->update(['author_no' => $from]);
    }

    return redirect()->route('user.home.single.show', ['conf' => $confUrl->url, 'paperId' => $paperId]);
  }

  public function changeContact(Conference $confUrl, $paperId, $authorId)
  {

    $this->isAllowedAuthor($confUrl);
    $submission = Submission::findOrFail($paperId);
    //
    if ($submission->authors->sortByDesc('is_primary')->first()->update(['is_primary' => 0])) {
      SubmissionAuthor::findOrFail($authorId)->update(['is_primary' => 1]);
    } else {
    }

    $this->viewData['conf'] = $confUrl;
    $this->viewData['submission'] = $submission;
    $this->viewData['authors'] = $submission->authors->sortByDesc('is_primary');

    return redirect()->route('user.home.single.show', ['conf' => $confUrl->url, 'paperId' => $paperId]);
  }

  public function removeAuthor(Conference $confUrl, $paperId, $authorId)
  {

    $this->isAllowedAuthor($confUrl);
    $submission = Submission::findOrFail($paperId);
    $author = SubmissionAuthor::findOrFail($authorId);
    //
    if ($author->is_primary === 0) {
      $author->delete();
    }


    return redirect()->route('user.home.single.show', ['conf' => $confUrl->url, 'paperId' => $paperId]);
  }

  public function editAuthor(Conference $confUrl, $paperId, $authorId)
  {
    $this->isAllowedAuthor($confUrl);
    $submission = Submission::findOrFail($paperId);

    $this->viewData['conf'] = $confUrl;
    $this->viewData['submission'] = $submission;
    $this->viewData['authors'] = $submission->authors->sortByDesc('is_primary');
    $this->viewData['authorCount'] = $submission->authors->count();

    $this->viewData['singleAuthor'] = SubmissionAuthor::findOrFail($authorId);
    $this->viewData['edit']   = true;

    return view('users.home.single', $this->viewData);
  }

  public function updateAuthor(Request $request, Conference $confUrl, $paperId, $authorId)
  {
    $this->isAllowedAuthor($confUrl);

    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email',
      'phone' => 'required'
    ]);

    if ($validator->fails()) {
      return redirect()
      ->back()
      ->withErrors($validator)
      ->withInput();
    }

    $author = SubmissionAuthor::findOrFail($authorId);
    $author->update($request->all());

    // $submission = Submission::findOrFail($paperId);
    //
    // if ($submission->authors->count() === 0) {
    //   $author->is_primary = 1;
    // }
    //
    // $submission->authors()->save($author);
    //
    return redirect()->route('user.home.single.show', ['confUrl' => $confUrl->url, 'paperId' => $paperId]);
    // $submission = Submission::findOrFail($paperId);
    //
    // $this->viewData['conf'] = $confUrl;
    // $this->viewData['submission'] = $submission;
    // $this->viewData['authors'] = $submission->authors->sortByDesc('is_primary');
    //
    // $this->viewData['author'] = SubmissionAuthor::findOrFail($authorId);
    // $this->viewData['edit']   = true;
    // //
    //
    // return view('users.home.single', $this->viewData);
  }

  public function showProfile($userId) {
    $showUser = User::findOrFail($userId);

    $this->viewData['showUser']    = $showUser;
    $this->viewData['conferences'] = Conference::all();
    $this->viewData['conf'] = Conference::first();

    $countryList = new CountryList();

    $this->viewData['userCountry'] = $countryList->getById($showUser->country);

    return view('users.home.profile', $this->viewData);
  }

  public function editProfile($userId) {
    $countryList = new CountryList();
    $this->viewData['countryList'] = $countryList->getList();

    $this->viewData['editedUser'] = User::findOrFail($userId);
    // dd($this->viewData['editedUser']);

    return view('users.home.edit', $this->viewData);
  }

  public function updateProfile(Request $request, $userId) {
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
            ->route('user.profile.edit', ['userId' => $editedUser->id])
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
      flash()->success('Success Updating Your Profile');
    }
    //
    $this->viewData['editedUser'] = $editedUser;
    //
    return redirect()->route('user.profile', ['userId' => $editedUser->id]);
  }

  protected function checkAllowed() {
    if ($this->user === null || !$this->user->isAdmin()) {
      abort(404);
    }
  }
}
