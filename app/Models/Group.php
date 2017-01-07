<?php

namespace Ivy\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /** @var int ACCESS_PUBLIC */
    const ACCESS_PUBLIC = 1;

    /** @var int ACCESS_PRIVATE */
    const ACCESS_PRIVATE = 0;

    /** @var array $fillable */
    protected $fillable = [
        'name', 'description', 'tag', 'public',
    ];

    /** @return Illuminate\Database\Eloquent\Collection */
    public function tags()
    {
        return $this->belongsToMany('Ivy\Model\Tag');
    }

    /** @return Illuminate\Database\Eloquent\Collection */
    public function users()
    {
        return $this->belongsToMany('Ivy\Model\User');
    }

    /**
     * Get all group tags.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function listTags()
    {
        return Tag::where('type', 'group')->orderBy('description')->get();
    }

    /**
     * Save the model to the database.
     *
     * @param array $aOptions
     * @return bool
     */
    public function save(array $aOptions = [])
    {
        $iTag = $this->tag;
        unset($this->tag);
        $bReturn = parent::save($aOptions);
        $this->tags()->sync([$iTag]);
        return $bReturn;
    }
}
