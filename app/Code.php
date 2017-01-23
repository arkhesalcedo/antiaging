<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    protected $fillable = [
        'name', 'codes'
    ];

    public function page()
    {
    	return $this->hasMany(Page::class);
    }
}
