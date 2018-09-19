<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
	use Sluggable;
	

   	public function tests()
    {
    	return $this->hasMany(Test::class);
    }

    public function author()
    {
    	return $this->hasOne(User::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
