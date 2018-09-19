<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Test extends Model
{
    use Sluggable;


	public function author()
    {
    	return $this->hasOne(User::class);
    }

    public function event()
    {
    	return $this->hasOne(Event::class);
    }

    public function questions()
    {
    	return $this->hasMany(Question::class);
    }

    public function answers()
    {
    	return $this->hasMany(Answer::class);
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
