<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
  protected $table = 'websites';

  protected $fillable = [
    'confererence_id',
    'overview',
    'policies'
  ];

  public function conference()
  {
    return $this->belongsTo('App\Conference');
  }
}
