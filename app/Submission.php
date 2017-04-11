<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
  use SoftDeletes;

  protected $table = 'submissions';
  protected $fillable =[
    'user_id',
    'conference_id',
    'status',
    'title',
    'abstract',
    'keywords',
    'active_version'
  ];

  protected $dates = ['deleted_at'];


  public function authors()
  {
    return $this->hasMany('App\SubmissionAuthor');
  }

  public function versions()
  {
    return $this->hasMany('App\SubmissionPaper');
  }

  public function uploader()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function conference()
  {
    return $this->belongsTo('App\Conference', 'conference_id');
  }

  public function getCurrentActivePath()
  {
    $activeVersion = $this->versions->where('version', $this->active_version)->first();

    if (!is_null($activeVersion)) {
      return $activeVersion->path;
    } else {
      return null;
    }
  }

  public function isDeleted()
  {
    if ($this->deleted_at->year < 0) {
        return false;
    } else {
        return true;
    }
  }
}
