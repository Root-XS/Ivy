<?php

namespace Ivy\Http\Controllers;

use Auth;
use Redirect;

class IndexController extends Controller
{
    /** Skip this controller if logged in. */
    protected function general()
    {
        if (Auth::check())
            return Redirect::to('/home');
    }

    /** Default Homepage */
    public function getIndex() {}
}
