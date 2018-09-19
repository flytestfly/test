<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Event extends Model
{
	use Sluggable;


	protected $fillable = [
        'title'
    ];


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

    public static function add($fields)
    {
        $event = new static;
        $event = fill($fields);
        $event = save();

        return $event;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this = save();
    }

    public function remove()
    {
        $this = delete();
    }

}
