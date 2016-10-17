<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubmissionAuthor extends Model
{
  protected $table = 'submissions_authors';

  protected $fillable =[
    'submission_id',
    'author_no',
    'name',
    'email',
    'phone',
    'address',
  ];

  public function submission()
  {
    return $this->belongsTo('App\Submission', 'submission_id');
  }
}
