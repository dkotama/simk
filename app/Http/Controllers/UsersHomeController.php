<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\SubmitPaperRequest;
use App\User;
use App\Conference;
use Illuminate\Support\Facades\Input;
use Response;
use Validator;
use App\RoleWriter;
// use App\Http\Requests;

class UsersHomeController extends Controller
{

  protected $viewData = [];

  public function __construct()
  {
    $this->middleware('auth');
    parent::__construct();

    $this->viewData['conferences'] = $this->user->authoring()->get();
  }

  public function index()
  {
    return view('users.home.index', $this->viewData);
  }

  public function addPaper(Conference $confUrl)
  {
    $this->viewData['conf'] = $confUrl;
    
    return view('users.home.add', $this->viewData);
  }
  
  public function manage(Conference $confUrl)
  {
    $this->viewData['conf'] = $confUrl;
    
    return view('users.home.manage', $this->viewData);
  }

  public function join(Conference $confUrl)
  {
    $this->viewData['conf'] = $confUrl;

    $writer = new RoleWriter($confUrl, $this->user, 'author');

    // if ($writer->attach()) {
    //   flash()->success('Succes joining, now you can submit paper');
    // } else {
    //   flash()->error('You are already joined');
    // }

    return view('users.home.manage', $this->viewData);
    // return view('welcome');
  } 

  public function submitPaper(Request $request) { 
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
      $paper = $request->file('paper');

      // // setting up rules
      // $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
      // // doing the validation, passing post data, rules and the messages
      // $validator = Validator::make($file, $rules);

      // if ($validator->fails()) {
      //   // send back to the page with the input data and errors
      //   return Redirect::to('upload')->withInput()->withErrors($validator);
      // } else {
      //   // checking file is valid.
      //TODO : ADD INSERT TO SUBMISSION
      // if ($paper->isValid()) {
      //     // dd($paper);
      //     $destinationPath = 'uploads'; // upload path
      //     $extension = $paper->getClientOriginalExtension(); // getting image extension
      //     $fileName = rand(11111,99999).'.'.$extension; // renameing image
      //     $paper->move($destinationPath, $fileName); // uploading file to given path

      //     flash()->success('Succes upload');
      // } else {
      //     flash()->error('Error Uploading');
      // }

    // return redirect()->back();
  }

  public function showSingleConference(Conference $confUrl)
  {
    $this->viewData['conf'] = $confUrl;

    return view('admins.conferences.edit', $this->viewData);
  }

  public function showAllConferences()
  {
    // FIXME add pagination for all conferences
    $this->viewData['confs'] = Conference::all();

    return view('admins.conferences.all', $this->viewData);
  }

  public function storeNewConference(StoreConferenceRequest $request)
  {
    //FIXME please add validation date
    flash()->success('Create New Conference Success');

    return redirect()->back();
  }

  public function updateConference(StoreConferenceRequest $request, Conference $confUrl)
  {
    $confUrl->update($request->all());
    flash()->success('Conferece Succesfully Updated');

    return redirect()->back();
  }

  protected function checkAllowed() {
    if ($this->user === null || !$this->user->isAdmin()) {
      abort(404);
    }
  }
}
