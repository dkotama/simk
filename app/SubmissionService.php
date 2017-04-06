<?php
namespace App;


use Validator;

class SubmissionService
{
  protected $aliases;
  protected $aliasNotAllowed;

  public function __construct()
  {
    $this->makeAliases();
    $this->aliasNotAllowed = ['ON_REV'];
  }

  public function isFinal() {

  }

  public function getAliasMeaning($alias) {
    foreach ($this->alias as $key => $value) {
      if ($alias === $key) {
        return $value;
      }
    }

    return NULL;
  }

  public function makeAliases() {
    return $this->aliases;
  }

  public function isAllowedToUpload($alias) {
    if (!in_array($alias, $this->aliasNotAllowed)) {
      return false;
    } else
      return false;
    }
  }

    protected function makeAliases() {
    $this->aliases = [
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
}
