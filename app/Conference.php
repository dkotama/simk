<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Conference extends Model
{
  protected $fillable =[
    'name',
    'url',
    'description'
  ];

  public $visibleDates = [];

  // public function __construct() {
  //   $this->getVisibleDates();
  //   dd($this->visibleDates);
  // }

  public function authors()
  {
    return $this->belongsToMany('App\User', 'authors', 'conference_id', 'user_id');
  }

  public function reviewers()
  {
    return $this->belongsToMany('App\User', 'reviewers', 'conference_id', 'user_id');
  }

  public function organizers()
  {
    return $this->belongsToMany('App\User', 'organizers', 'conference_id', 'user_id');
  }

  public function participants()
  {
    return $this->belongsToMany('App\User', 'participants', 'conference_id', 'user_id');
  }

  public function website()
  {
    return $this->hasOne('App\Website');
  }


  public function participantAppl() {
    return $this->hasMany('App\ParticipantApplication');
  }

  public static function getByUrl($url)
  {
    return static::whereUrl($url)->firstOrFail();
  }

  public function submissions() {
    return $this->hasMany('App\Submission');
  }

  public function reviewQuestions() {
    return $this->hasOne('App\ReviewQuestion');
  }

  public function dates() {
    return $this->hasMany('App\ConferenceDate');
  }

  public function getVisibleArray() {
    $dates = $this->dates()->where('is_visible', 1)->get();
    $temp  = [];
    $boldNum = count($dates) - 1;
    $count = 0;

    foreach ($dates as $key => $value) {
      $tag = 'del';

      if ($count === $boldNum) { $tag = 'b'; }

      $temp['submission_deadline'][$key] = [
        'date' => Carbon::parse($value->submission_deadline)->toFormattedDateString(),
        'tag' => $tag
      ];

      $temp['acceptance'][$key] = [
        'date' => Carbon::parse($value->acceptance)->toFormattedDateString(),
        'tag' => $tag
      ];

      $temp['camera_ready'][$key] = [
        'date' => Carbon::parse($value->camera_ready)->toFormattedDateString(),
        'tag' => $tag
      ];

      $temp['registration'][$key] = [
        'date' => Carbon::parse($value->registration)->toFormattedDateString(),
        'tag' => $tag
      ];

      $temp['start_conference'][$key] = [
        'date' => Carbon::parse($value->start_conference)->toFormattedDateString(),
        'tag' => $tag
      ];

      $temp['end_conference'][$key] = [
        'date' => Carbon::parse($value->end_conference)->toFormattedDateString(),
        'tag' => $tag
      ];

      $count++;
    }

    return collect($temp);
  }

  public function getVisibleCollection() {
    return $this->dates()->where('is_visible', 1)->get();
  }

  public function getLastDate() {
    $temp = $this->dates()->where('is_visible', 1)->get();

    return $temp->last();
  }

  public function isCanUpload() {
    $lastDate = $this->getLastDate();
    $lastDate = Carbon::parse($lastDate->submission_deadline, 'Asia/Makassar');
    $now      = Carbon::now('Asia/Makassar');
    $diff     = $now->diffInDays($lastDate, false);

    return ($diff > 0);
  }

  public function isCanUploadCameraReady() {
    $lastDate = $this->getLastDate();
    $lastDate = Carbon::parse($lastDate->camera_ready);
    $now      = Carbon::now('Asia/Makassar');
    $diff     = $now->diffInDays($lastDate, false);

    return ($diff > 0);
  }

  public function isCanRegister() {
    $lastDate = $this->getLastDate();
    $lastDate = Carbon::parse($lastDate->camera_ready);
    $now      = Carbon::now('Asia/Makassar');
    $diff     = $now->diffInDays($lastDate, false);

    return ($diff > 0);
  }

  public function getDate($dateName) {
    $lastDate = $this->getLastDate()->toArray();

    return Carbon::parse($lastDate[$dateName])->toFormattedDateString();
  }
}
