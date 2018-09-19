<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function author()
    {
    	return $this->hasOne(User::class);
    }

    public function question()
    {
    	return $this->hasOne(Question::class);
    }

   	public function answers_option()
    {
    	return $this->hasOne(Answers_option::class);
    }
}
