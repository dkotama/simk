<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConferenceDate extends Model
{
    protected $table = 'conferences_dates';

    protected $fillable = [
      'submission_deadline',
      'acceptance',
      'camera_ready',
      'registration',
      'start_conference',
      'end_conference'
    ];

    public function conference() {
      return $this->belongsTo('App\Conference');
    }
}
