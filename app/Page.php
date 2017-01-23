<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'slug', 'theme_id', 'code_id', 'link_id'
    ];

    public function theme()
    {
    	return $this->belongsTo(Theme::class);
    }

    public function code()
    {
    	return $this->belongsTo(Code::class);
    }

    public function link()
    {
    	return $this->belongsTo(Link::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = strtolower($value);
    }

    public function add($request)
    {
        $start = $request->slug;
        $end = $request->slug_end;

        if ($end) {
            while ($start <= $end) {
                $this::create([
                    'slug' => $start,
                    'theme_id' => $request->theme_id,
                    'link_id' => $request->link_id,
                    'code_id' => 0
                ]);

                $start++;
            }
        } else {
            $this::create($request->input());
        }
    }
}
