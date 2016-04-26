<?php

namespace Ivy\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Ivy\Model\Group;
use Ivy\Model\Tag;

class GroupsController extends Controller
{
    /** Show the application dashboard. */
    public function getIndex() {}

    /**
     * Edit a Group record.
     *
     * @param int $id Group ID.
     */
    public function getEdit(int $id)
    {
        $this->layout->oGroup = Group::find($id);
    }

    /**
     * Update a Group record.
     *
     * @param int $id Group ID.
     */
    public function postEdit(int $id)
    {
        Group::find($id)->fill(request()->input())
            ->save();
        return Redirect()->back()
            ->with('success', 'Group saved successfully.');
    }

    /**
     * Show Groups with a certain Tag.
     *
     * @param int $iTagId
     */
    public function getTag(int $iTagId)
    {
        $this->layout->oDisplayedTag = Tag::find($iTagId);
    }

    /**
     * Save group data.
     *
     * @param Illuminate\Http\Request $oRequest
     * @return Illuminate\Http\Response
     */
    public function postSave(Request $oRequest)
    {
        $oValidator = Validator::make($oRequest->all(), [
            'name' => 'required|max:64',
            'description' => 'required|max:255',
            'tag' => 'integer',
            'public' => 'integer',
        ]);

        if ($oValidator->fails()) {
            $this->throwValidationException($oRequest, $oValidator);
        }

        Group::create($oRequest->all());

        return redirect()->back()->with('success', 'Group saved successfully!');
    }
}
