<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionReviewer extends Model
{
  protected $table = 'submissions_reviewers';

  protected $fillable =[
    'submission_id',
    'user_id',
    'score',
    'note'
  ];

  public function submission()
  {
    return $this->belongsTo('App\Submission', 'submission_id');
  }

  public function user()
  {
    return $this->hasOne('App\User');
  }
}
