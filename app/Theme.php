<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'name', 'html'
    ];

    public function page()
    {
    	return $this->hasMany(Page::class);
    }
}
