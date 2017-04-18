<?php
namespace App;


use Validator;

class SubmissionService
{
  protected $paperAliases;
  protected $scoreAliases;
  protected $aliasNotAllowed;

  public function __construct()
  {
    $this->aliasNotAllowed = ['ON_REV'];
  }

  public function isFinal() {

  }

  public function getPaperAliasMeaning($alias) {
    foreach ($this->paperAliases as $key => $value) {
      if ($alias === $key) {
        return $value;
      }
    }

    return NULL;
  }

  public function getScoreAliasMeaning($alias) {
    foreach ($this->scoreAliases as $key => $value) {
      if ($alias === $key) {
        return $value;
      }
    }

    return NULL;
  }
  public function getPaperAliases() {
    return $this->paperAliases;
  }

  public function getScoreAliases() {
    return $this->scoreAliases;
  }

  public function isAllowedToUpload($alias) {
    if (!in_array($alias, $this->aliasNotAllowed)) {
      return false;
    } else
      return false;
    }
  }


  protected function makeAliases() {
    $this->paperAliases = [
      'ON_REV' => 'On Review Process',
      'REJECT' => 'Rejected',
      'REV_MIN' => 'Minor Revision',
      'REV_MAJ' => 'Major Revision',
      'ACC_REV_MIN' => 'Accepted - Minor Revision',
      'ACC_REV_MAJ' => 'Accepted - Major Revision',
      'ACC_WAIT_PAY' => 'Accepted - Awaiting Payment',
      'PUBLISHED' => 'Accepted - Minor Revision'
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
}
