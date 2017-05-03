<?php
namespace App;

class SubmissionService
{
  protected $paperAliases;
  protected $scoreAliases;
  protected $recommendationAliases;
  protected $resolveAliases;
  protected $aliasNotAllowed;

  public function __construct()
  {
    $this->aliasNotAllowed = ['ON_REV'];
  }

  public function isFinal() {

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
      'REJECT' => 'Rejected',
      'REV_MIN' => 'Minor Revision',
      'REV_MAJ' => 'Major Revision',
      'ACC_REV_MIN' => 'Accepted - Minor Revision',
      'ACC_REV_MAJ' => 'Accepted - Major Revision',
      'ACC_WAIT_PAY' => 'Accepted - Awaiting Payment',
      'ACC' => 'Accepted',
    ];
  }

  protected function makeResolveAliases() {
    $this->resolveAliases = [
      'REJECT' => 'Reject',
      'REV_MIN' => 'Minor Revision',
      'REV_MAJ' => 'Major Revision',
      'ACC_REV_MIN' => 'Accept - Minor Revision',
      'ACC_REV_MAJ' => 'Accept - Major Revision',
      'ACC_WAIT_PAY' => 'Accept Paper'
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
