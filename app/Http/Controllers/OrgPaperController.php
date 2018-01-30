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
use Mail;

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
    // dd($submissions->first()->uploader->isParticipating($confUrl));
    $this->viewData['submissions'] = $submissions;
    $this->viewData['paperSelected'] = 'onprogress';
    // dd($this->conf->submissions);

    return view('organizers.papers.all', $this->viewData);
  }

  public function proceeding($confUrl)
  {
    $submissions = Submission::withTrashed()->where('conference_id', $confUrl->id)->get();
    $this->viewData['submissions'] = $submissions;
    $this->viewData['paperSelected'] = 'proceeding';

    return view('organizers.papers.proceeding', $this->viewData);
  }


  public function singlePaper(Conference $confUrl, $paperId)
  {
    $submission = Submission::find($paperId);
    $questions  = $confUrl->reviewQuestions;
    $versions = $submission->versions;

    $now = Carbon::now('Asia/Makassar');
    $acceptance = $confUrl->getLastAccepted();
    $warning = false;

    if($now->diffInDays($acceptance) <= 7) {
      $warning = true;
    }

    $this->viewData['submission']  = $submission;
    $this->viewData['questions']   = $questions;
    $this->viewData['authors']     = $submission->authors->sortBy('author_no');
    $this->viewData['authorCount'] = $submission->authors->count();
    $this->viewData['versions']    = $versions;
    $this->viewData['reviewers']   = $submission->reviewers;
    $this->viewData['warning']     = $warning;

    return view('organizers.papers.single', $this->viewData);
  }

  public function mailWarning(Conference $confUrl, $userId, $paperId) {
        $user = User::find($userId);
        $submission = Submission::find($paperId);
        dd($confUrl->name);
        $userData = [
          'name'  => $user->last_name . ', ' . $user->first_name,
          'title' => $user->salutation,
          'conf_title' => $confUrl->name,
          'email' => $user->email
        ];

        Mail::send('emails.warning', $userData, function ($message) use ($userData) {
          $message->from('simk.noreply@domain.com', 'SIMK Automail');

          $message->to($userData['email'])->subject('SIMK Review Reminder');
        });

        flash()->success('Send Warning Success');
        return redirect()->back();
  }

  public function restorePaper(Conference $confUrl, $paperId)
  {
    $submission = Submission::withTrashed()->where('id', $paperId)->first();
    //
    if ($submission->restore()) {
      flash()->success('Success Restore Paper.');
    }

    return redirect()->route('organizer.allPapers', $confUrl->url);
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

    if($submission->getLastPaper()->is_camera_ready === 1){
      unset($aliases["ACC_REV_MAJ"]);
    }

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

  // public function validatePayment(Conference $confUrl, $paperId)
  // {
  //     dd('validatePayment, ' . $paperId);
  // }

  public function postValidation(Conference $confUrl, $paperId, Request $requests)
  {
    // dd($requests->all());

    $validation = $requests->validation;

    $submission = Submission::findOrFail($paperId);

    if ($validation === 'WAIT_PAY') {
      $submission->update(['payment_proof' => NULL, 'payment_notes' => $requests->payment_notes]);
    }

    $paper = $submission->versions->last();
    $paper->update(['status' => $validation]);

    flash()->success('Success Validating Payment');

    return redirect()->route('organizer.paper.showSingle', ['confUrl' => $confUrl->url, 'paperId' => $paperId]);
  }

  public function showSingleReview(Conference $confUrl, $paperId, $reviewerId) {
    $submission = Submission::findOrFail($paperId);
    $questions  = $confUrl->reviewQuestions;
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
    $questions  = $confUrl->reviewQuestions;
    $reviewers  = $submission->reviewers;
    // $reviews    = $reviewer->getReviewedPaper($paperId);


    $this->viewData['submission']  = $submission;
    $this->viewData['questions']   = $questions;
    $this->viewData['reviewers']   = $reviewers;


    return view('organizers.papers.allreview', $this->viewData);
  }

}
