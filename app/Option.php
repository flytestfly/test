<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function author()
    {
    	return $this->hasOne(User::class);
    }

    public function question()
    {
    	return $this->hasOne(Question::class);
    }
}
