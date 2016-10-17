<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
  protected $table = 'submissions';
  protected $fillable =[
    'user_id',
    'conference_id',
    'status'
  ];

  public function paperAuthors()
  {
    return $this->hasMany('App\SubmissionAuthor');
  }

  public function author()
  {
    return $this->belongsTo('App\User');
  }
}
