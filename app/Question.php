<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   	public function author()
    {
    	return $this->hasOne(User::class);
    }

    public function test()
    {
        return $this->hasOne(Test::class);
    }

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function answers_option()
    {
        return $this->hasOne(Answers_option::class);
    }
}
