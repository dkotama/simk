<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Conference;
use App\Submission;
use App\SubmissionAuthor;
use App\SubmissionPaper;
use App\SubmissionService;
use App\ReviewQuestion;
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
    $submission = Submission::findOrFail($paperId);
    $questions  = ReviewQuestion::findOrFail($confUrl->id);

    $this->viewData['submission']  = $submission;
    $this->viewData['questions']   = $questions;
    $this->viewData['authors']     = $submission->authors->sortBy('author_no');
    $this->viewData['authorCount'] = $submission->authors->count();
    $this->viewData['reviewers']   = $submission->reviewers;

    return view('organizers.papers.single', $this->viewData);
  }

  public function attachReviewer(Conference $confUrl, $paperId, $userId)
  {
    $paper    = Submission::findOrFail($paperId);
    $reviewer = User::findOrFail($userId);

    if ($paper->reviewers()->attach($reviewer->id) == NULL){
      flash()->success('Set Reviewer Success!');
    }

    // dd($paper->reviewers);
    return redirect()->back();
  }

  public function detachReviewer(Conference $confUrl, $paperId, $userId)
  {
    $paper    = Submission::findOrFail($paperId);
    $reviewer = User::findOrFail($userId);

    if ($paper->reviewers()->detach($reviewer->id) == false){
      flash()->success('Unset Reviewer Success!');
    }

    return redirect()->back();
  }

  public function assignReviewer(Conference $confUrl, $paperId)
  {
    $submission = Submission::findOrFail($paperId);

    $this->viewData['reviewers'] = $confUrl->reviewers;
    $this->viewData['submission']  = $submission;

    return view('organizers.papers.assign', $this->viewData);
  }

  public function resolvePaper(Conference $confUrl, $paperId)
  {
    $submission = Submission::findOrFail($paperId);
    $service    = new SubmissionService();

    $aliases = $service->getResolveAliases();

    $this->viewData['submission']  = $submission;
    $this->viewData['aliases']     = $aliases;

    return view('organizers.papers.resolve', $this->viewData);
  }

  public function postResolve(Conference $confUrl, $paperId, Request $requests)
  {
      $submission = Submission::findOrFail($paperId);
      $submission = $submission->versions->last();
      $submission->status = $requests->status;
      $submission->save();


      flash()->success('Success Resolve Paper');

      return redirect()->route('organizer.paper.showSingle', ['confUrl' => $confUrl->url, 'paperId' => $paperId]);
  }
}
