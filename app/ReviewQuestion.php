<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewQuestion extends Model
{
  protected $table = 'review_questions';
  protected $fillable =[
    'conference_id',
    'topic_a',
    'topic_b',
    'topic_c',
    'topic_d',
    'topic_e',
    'topic_f',
    'question_a',
    'question_b',
    'question_c',
    'question_d',
    'question_e',
    'question_f'
  ];
  
  public function conference()
  {
    return $this->belongsTo('App\Conference');
  }
}
