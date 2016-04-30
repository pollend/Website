<?php

namespace PN\Forum\Traits;

trait HasAuthor
{
    /**
     * Relationship: Author.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(config('forum.integration.user_model'));
    }

    /**
     * Attribute: Author name.
     *
     * @return mixed
     */
    public function getUserNameAttribute()
    {
        $attribute = config('forum.integration.user_name');

        if (!is_null($this->user)) {
            return $this->user->$attribute;
        }

        return null;
    }
}
