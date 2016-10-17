<?php 

namespace App;


use App\User;
use Auth;
/**
* 
*/
class RoleWriter
{
	protected $conf = null;
  protected $user = null;
  protected $mode = null;

	public function __construct($conf, $user, $mode)
	{ 
    $this->conf = $conf;
    $this->user = $user;
    $this->mode = $mode;
	}

	public function attach() 
	{ 
    $success = 1;

    if ($this->mode === 'author' && !$this->user->isAuthoring($this->conf)) {
      $success = $this->user->authoring()->attach($this->conf->id);
    } else if ($this->mode === 'reviewer' && !$this->user->isReviewing($this->conf)) {
      $success = $this->user->reviewing()->attach($this->conf->id);
    } else if ($this->mode === 'organizer' && !$this->user->isOrganizing($this->conf)) {
      $success = $this->user->organizing()->attach($this->conf->id);
    } else if ($this->mode === 'admin' && !$this->user->isAdmin()) {
      $this->user->is_admin = true;
      $success = $this->user->save();
    }

    // if ($mode !== 'admin') {
    //   flash()->success($user->last_name . ' is now ' . $mode . ' of ' . $confUrl->name);
    // } else {
    //   flash()->success($user->last_name . ' is now an Administrator of SIMK');
    // }
    if ($success === null) {
      return true;
    } else {
      return false;
    }
  }
}