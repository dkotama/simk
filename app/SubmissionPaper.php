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
}
