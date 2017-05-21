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
    $versions = $submission->versions;

    $this->viewData['submission']  = $submission;
    $this->viewData['questions']   = $questions;
    $this->viewData['authors']     = $submission->authors->sortBy('author_no');
    $this->viewData['authorCount'] = $submission->authors->count();
    $this->viewData['versions']    = $versions;
    $this->viewData['reviewers']   = $submission->reviewers;

    return view('organizers.papers.single', $this->viewData);
  }

  public function postBlindPaper(Conference $confUrl, $paperId, Request $request)
  {
    $rules['paper'] = 'required|mimes:doc,docx|max:5000';
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator->errors());
    }

    $submission = Submission::find($paperId);
    $submissionPaper = $submission->getLastPaper();
    //
    $paper = $request->file('paper')  ;
    //
    if ($paper->isValid()) {
        $extension = $paper->getClientOriginalExtension(); // getting image extension
        $fileName = md5(uniqid('', true) . microtime()) . '.' . $extension; // renaming image
        $paper->move('uploads', $fileName); // uploading file to given path
        $submissionPaper->update(['blind_version' => $fileName, 'status' => 'WAIT_REV']);
    }

    flash()->success('Success uploading Blind Version!');
    return redirect()->route('organizer.paper.showSingle', ['confUrl' => $confUrl->url, 'paperId' => $submission->id]);
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

    if (!$submission->isCanAssignReviewer() || $submission->isPaperResolved()) {
      abort(404);
    }

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

      ($requests->notes != NULL) ? $submission->notes = $requests->notes : NULL;

      $submission->save();


      flash()->success('Success Resolve Paper');

      return redirect()->route('organizer.paper.showSingle', ['confUrl' => $confUrl->url, 'paperId' => $paperId]);
  }

  public function showSingleReview(Conference $confUrl, $paperId, $reviewerId) {
    $submission = Submission::findOrFail($paperId);
    $questions  = ReviewQuestion::findOrFail($confUrl->id);
    $reviewer   = User::findOrFail($reviewerId);
    $reviews    = $reviewer->getReviewedPaper($paperId);

    $this->viewData['questions']   = $questions;
    $this->viewData['submission']  = $submission;
    $this->viewData['reviews']     = $reviews;
    $this->viewData['reviewer']    = $reviewer;

    return view('organizers.papers.single_review', $this->viewData);
  }

  public function showAllReview(Conference $confUrl, $paperId) {
    $submission = Submission::findOrFail($paperId);
    $questions  = ReviewQuestion::findOrFail($confUrl->id);
    $reviewers  = $submission->reviewers;
    // $reviews    = $reviewer->getReviewedPaper($paperId);


    $this->viewData['submission']  = $submission;
    $this->viewData['questions']   = $questions;
    $this->viewData['reviewers']   = $reviewers;


    return view('organizers.papers.allreview', $this->viewData);
  }

}
