<?php

namespace Ivy\Http\Controllers;

use Redirect;
use Ivy\Model\User;

class PeopleController extends Controller
{
    /** Show the application dashboard. */
    public function getIndex() {}

    /**
     * Edit a User record.
     *
     * @param int $id User ID.
     */
    public function getEdit(int $id)
    {
        $this->layout->oUser = User::find($id);
    }

    /**
     * Update a User record.
     *
     * @param int $id User ID.
     */
    public function postEdit(int $id)
    {
        User::find($id)->fill(request()->input())
            ->save();
        return Redirect()->to('/people/edit/'. $id)
            ->with('success', 'User saved successfully.');
    }

    /** Search Users. */
    public function getSearch()
    {
        $this->layout->cResults = User::orderBy('firstname')
            ->orderBy('lastname')
            ->where('email', 'LIKE', '%' . request('q') . '%')
            ->orWhere(function($oQuery){
                $aWords = explode(' ', trim(request('q')));
                $strFirstWord = trim(array_shift($aWords));
                $oQuery->where('firstname', 'LIKE', '%' . $strFirstWord . '%');
                // If multiple words are present, use the remaining ones as lastnames.
                if (count($aWords))
                    $oQuery->where('lastname', 'LIKE', '%' . trim(implode(' ', $aWords)) . '%');
                // If only one word was given, check it against first AND last names.
                else
                    $oQuery->orWhere('lastname', 'LIKE', '%' . $strFirstWord . '%');
            })
            ->get();
    }
}
