<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answers_option extends Model
{
    public function author()
    {
    	return $this->hasOne(User::class);
    }

    public function question()
    {
    	return $this->hasOne(Question::class);
    }

    public function answer()
    {
    	return $this->hasOne(Answer::class);
    }

    public function option()
    {
    	return $this->hasOne(Option::class);
    }
}
