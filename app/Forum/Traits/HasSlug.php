<?php

namespace PN\Forum\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    /**
     * Attribute: Slug
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }
}
