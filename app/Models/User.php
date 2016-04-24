<?php

namespace Ivy\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @var array $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'name', 'firstname', 'lastname', 'email', 'password',
    ];

    /** @var array $hidden The attributes that should be hidden for arrays. */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /** @return string Get User's full name (first & last). */
    public function getFullnameAttribute()
    {
        return trim($this->firstname . ' ' . $this->lastname);
    }

    /** @param string $strValue Set firstname & lastname given fullname. */
    public function setFullnameAttribute(string $strValue)
    {
        $aParts = explode(' ', $strValue);
        $this->firstname = array_shift($aParts);
        $this->lastname = implode(' ', $aParts);
    }

    /** @return string Alias for "fullname." */
    public function getNameAttribute()
    {
        return $this->fullname;
    }

    /** @param string $strValue Alias for "fullname." */
    public function setNameAttribute(string $strValue)
    {
        $this->fullname = $strValue;
    }
}
