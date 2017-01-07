<?php

namespace Ivy\Model;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    /** @return Illuminate\Database\Eloquent\Collection */
    public function users()
    {
        return $this->belongsToMany('Ivy\Model\User', 'user_abilities');
    }
}
