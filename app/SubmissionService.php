<?php
namespace App;

use Validator;

class SubmissionService
{
  protected $paperAliases;
  protected $scoreAliases;
  protected $recommendationAliases;
  protected $resolveAliases;
  protected $aliasNotAllowed;

  protected $uploadFolder = 'uploads';

  public function update($paperId, $request) {
    $rules = [
      'title' => 'required',
      'abstract' => 'required',
      'keywords' => 'required'
    ];

    $paperData = $request->all();
    $withPaper = false;

    if (isset($paperData['paper'])) {
      $rules['paper'] = 'required|mimes:doc,docx|max:5000';
      $withPaper      = true;
    } else {
      unset($paperData['url']);
    }

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return $validator->errors();
    }

    $submission = Submission::find($paperId);
    $update     = $submission->update($request->all());
    //
    $submissionPaper = $submission->getLastPaper();
    //
    $paper = $request->file('paper');
    //
    if ($withPaper && $paper->isValid()) {
        $extension = $paper->getClientOriginalExtension(); // getting image extension
        $fileName = md5(uniqid('', true) . microtime()) . '.' . $extension; // renaming image
        $paper->move($this->uploadFolder, $fileName); // uploading file to given path
        $submissionPaper->update(['path' => $fileName]);
    }

    return true;
  }

  public function getPaperAlias($alias) {
    $this->makePaperAliases();

    foreach ($this->paperAliases as $key => $value) {
      if ($alias === $key) {
        return $value;
      }
    }

    return NULL;
  }

  public function getScoreAlias($alias) {
    $this->makeScoreAliases();

    foreach ($this->scoreAliases as $key => $value) {
      if ($alias === $key) {
        return $value;
      }
    }

    return NULL;
  }

  public function getRecommedationAlias($alias) {
    $this->makeRecommendationAliases();

    foreach ($this->recommendationAliases as $key => $value) {
      if ($alias === $key) {
        return $value;
      }
    }

    return NULL;
  }

  public function getRecommendationAliases() {
    $this->makeRecommendationAliases();

    return $this->recommendationAliases;
  }

  public function getPaperAliases() {
    $this->makePaperAliases();

    return $this->paperAliases;
  }

  public function getResolveAliases() {
    $this->makeResolveAliases();

    return $this->resolveAliases;
  }

  public function getScoreAliases() {
    $this->makeScoreAliases();

    return $this->scoreAliases;
  }

  public function isAllowedToUpload($alias) {
    if (!in_array($alias, $this->aliasNotAllowed)) {
      return false;
    } else {
      return false;
    }
  }


  protected function makePaperAliases() {
    $this->paperAliases = [
      'ON_REV' => 'On Review Process',
      'WAIT_BLIND' => 'Waiting Blind Version',
      'WAIT_REV' => 'Waiting Revision',
      'WAIT_ORG' => 'Waiting Camera Ready Approval',
      'REJECT' => 'Rejected',
      'ACC_REV_MIN' => 'Accepted - Minor Revision',
      'ACC_REV_MAJ' => 'Accepted - Major Revision',
      'WAIT_PAY' => 'Accepted - Awaiting Payment',
      'WAIT_ORG_PAY' => 'Waiting Payment Validation'
    ];
  }

  protected function makeResolveAliases() {
    $this->resolveAliases = [
      'REJECT' => 'Reject',
      'ACC_REV_MIN' => 'Accept - Minor Revision',
      'ACC_REV_MAJ' => 'Accept - Major Revision',
      'WAIT_PAY' => 'Accept Paper'
    ];
  }


  protected function makeScoreAliases() {
    $this->scoreAliases = [
      '0' => 'Bad',
      '1' => 'Enough',
      '2' => 'Good',
      '3' => 'Excellent'
    ];
  }

  protected function makeRecommendationAliases() {
    $this->recommendationAliases = [
      '0' => 'Rejected',
      '1' => 'Revision',
      '2' => 'Accepted'
    ];
  }
}
