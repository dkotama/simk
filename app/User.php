<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Conference;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salutation', 'country', 'status', 'address', 'first_name', 'last_name', 'email', 'password', 'activated'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function authoring() {
        return $this->belongsToMany('App\Conference', 'authors', 'user_id', 'conference_id');
    }

    public function reviewing() {
        return $this->belongsToMany('App\Conference', 'reviewers', 'user_id', 'conference_id');
    }

    public function organizing() {
        return $this->belongsToMany('App\Conference', 'organizers', 'user_id', 'conference_id');
    }

    public function submissions() {
        return $this->hasMany('App\Submission');
    }

    public function isAuthoring(Conference $conf)
    {
        return $this->authoring()->whereId($conf->id)->exists();
    }

    public function isActivatedAuthor(Conference $conf)
    {
        return null;
        // return $this->authoring()->where('conference_id', $conf->id)->first()->pivot->activated;
    }

    public function getPayment(Conference $conf)
    {
        return null;
        // return $this->authoring()->where('conference_id', $conf->id)->first()->pivot;
    }

    public function isReviewing(Conference $conf)
    {
        return $this->reviewing()->whereId($conf->id)->exists();
    }

    public function isOrganizing(Conference $conf)
    {
        return $this->organizing()->whereId($conf->id)->exists();
    }

    public function isAdmin()
    {
        return (bool) $this->is_admin;
    }

    public function setAdmin()
    {
        $this->is_admin = 1;
        $this->save();
    }

    public function unsetAdmin()
    {
        $this->is_admin = 0;
        $this->save();
    }

}
