<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\SubmissionService;

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
    'active_version',
    'payment_proof',
    'payment_notes'
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

  public function reviewers() {
    return $this->belongsToMany('App\User', 'submissions_reviewers', 'submission_id', 'user_id')
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

  public function isReviewedBy($userID)
  {
    // return $this->hasManyThrough(
    //         'App\SubmissionReviewer', 'App\SubmissionPaper',
    //         'submission_id', 'paper_id', 'id');
  }

  public function papers()
  {
    return $this->hasMany('App\SubmissionPaper');
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

  public function getLastPaper()
  {
    return $this->papers->last();
  }

  public function getMainPaper()
  {
    return $this->papers->first();
  }

  public function isDeleted()
  {
    if ($this->deleted_at->year < 0) {
        return false;
    } else {
        return true;
    }
  }

  public function getStatusAlias()
  {
    $service  = new SubmissionService();

    $lastVersion = $this->versions->last();
    $lastVersion = $lastVersion->status;

    return $service->getPaperAlias($lastVersion);
  }

  public function getStatusCode()
  {
    $lastVersion = $this->versions->last();

    return $lastVersion->status;
  }

  public function getStatusFromAuthor()
  {
    $lastVersion = $this->versions->last();

    $service  = new SubmissionService();

    if ($lastVersion->status === 'WAIT_BLIND') {
      return 'Checking Process By Organizer';
    } else if ($lastVersion->status === 'WAIT_REV') {
      return 'Review Process';
    } else {
      return $service->getPaperAlias($lastVersion->status);
    }
  }

  public function getStatusFromReviewer()
  {
    $lastVersion = $this->versions->last();

    $service  = new SubmissionService();

    if ($lastVersion->status === 'WAIT_BLIND') {
      return 'Waiting Bling Review';
    } else if ($lastVersion->status === 'WAIT_REV') {
      return 'Waiting Your Review';
    } else {
      return $service->getPaperAlias($lastVersion->status);
    }
  }

  public function getStatus()
  {
    $lastVersion = $this->versions->last();

    $service  = new SubmissionService();

    return $service->getPaperAlias($lastVersion->status);
  }

  public function isAuthorCameraReady()
  {
    $lastVersion = $this->versions->last();

    if ($lastVersion->status === 'ON_REV' || $lastVersion->status === 'WAIT_REV') {
      return false;
    } else {
      return true;
    }
  }

  public function isCanEdit()
  {
    $lastVersion = $this->versions->last();

    if ($lastVersion->status === 'WAIT_BLIND') {
      return true;
    } else {
      return false;
    }
  }

  public function isCanAssignReviewer()
  {
    $lastVersion = $this->versions->last();

    if ($lastVersion->status === 'WAIT_REV') {
      return true;
    } else {
      return false;
    }
  }

  public function isPaperResolved()
  {
    $lastVersion = $this->versions->first();
    $status = $lastVersion->status;
    $service = new SubmissionService();
    $resolvedStatus = $service->getResolveAliases();

    foreach ($resolvedStatus as $key => $value) {
      if($key === $status) {
        return true;
      }
    }

    return false;
  }

  public function isCameraReadyApproved()
  {
    $lastVersion = $this->versions()->where('is_camera_ready', 1)->get()->last();

    if ($lastVersion != NULL) {
      $status = $lastVersion->status;

      if ($status === "ACC_WAIT_PAY" || $status === "WAIT_ORG" || $status === "ACC_WAIT_PAY") {
        return true;
      }
    }

    return false;
  }
  public function getLastPaperReadableStatus()
  {
    $lastVersion = $this->versions->last();
    $status = $lastVersion->status;

    $service  = new SubmissionService();
    $readable = $service->getPaperAliases();

    foreach ($readable as $key => $value) {
      if($key === $status) {
        return $value;
      }
    }

    return NULL;
  }

  public function availableForReview()
  {
    if ($this->getStatusCode() === 'ON_REV') {
      return true;
    } else {
      return false;
    }
  }
}
