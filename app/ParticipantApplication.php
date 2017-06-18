<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParticipantApplication extends Model
{
  protected $table = 'user_participant_proofs';

  protected $fillable = [
    'user_id',
    'conference_id',
    'payment_proof',
    'payment_notes'
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function conference()
  {
    return $this->belongsTo('App\Conference');
  }

  public function scopeUserid($query, $userId)
  {
      return $query->where('user_id', '=', $userId);
  }

  public function scopeConferenceid($query, $confId)
  {
      return $query->where('conference_id', '=', $confId);
  }
}
