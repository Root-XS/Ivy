<?php

namespace Ivy\Model;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * Get a relationship (overrides parent).
     *
     * Check for dynamic tag types if relationship method is undefined.
     *
     * @param string $strKey
     * @return mixed
     */
    public function getRelationValue($strKey)
    {
        $mReturn = parent::getRelationValue($strKey);

        if (!$mReturn) {
            $strKey = str_singular($strKey);
            $mReturn = $this->belongsToMany('Ivy\Model\\' . ucfirst($strKey), $strKey . '_tag')
                ->join('tags', $strKey . '_tag.tag_id', '=', 'tags.id')
                ->where('tags.type', $strKey);
        }

        return $mReturn;
    }
}
