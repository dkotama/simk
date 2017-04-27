<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
  protected $fillable =[
    'name',
    'url',
    'description',
    'start_date',
    'end_date',
    'start_submit',
    'end_submit'
  ];

  protected $dates = [
    'start_date',
    'end_date',
    'start_submit',
    'end_submit'
  ];

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
}
