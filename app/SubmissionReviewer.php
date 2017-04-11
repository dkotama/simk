<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionReviewer extends Model
{
  protected $table = 'submissions_reviewers';

  protected $fillable =[
    'submission_id',
    'path',
    'version',

  ];

  public function submission()
  {
    return $this->belongsTo('App\Submission', 'submission_id');
  }

  public function reviewers()
  {
    return $this->hasMany('App\Submission', 'submission_id');
  }
}
