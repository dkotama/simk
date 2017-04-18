<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionPaper extends Model
{
  protected $table = 'submissions_papers';

  protected $fillable =[
    'submission_id',
    'path',
    'version'
  ];

  public function submission()
  {
    return $this->belongsTo('App\Submission', 'submission_id');
  }

  public function reviewers() {
    return $this->belongsToMany('App\User', 'submissions_reviewers', 'paper_id', 'user_id')
          ->withPivot(
              'score_a',
              'score_b',
              'score_c',
              'score_d',
              'score_e',
              'score_f',
              'comments'
            );
  }
}
