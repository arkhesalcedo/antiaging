<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'slug', 'link', 'keywords'
    ];

    public function page()
    {
    	return $this->hasMany(Page::class);
    }
}
