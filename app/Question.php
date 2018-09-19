<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

    protected $fillable = [
        'question'
    ];

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

    public static function add($fields)
    {
        $question = new static;
        $question = fill($fields);
        $question = save();

        return $question;
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

    public function setTest($id)
    {   
        if($id == null) { return; }

        $this->test_id = $id;
        $this->save();
    }

    public function setDraft()
    {   
        $this->status = Test::IS_DRAFT;
        $this->save();
    }

    public function setPublic()
    {   
        $this->status = Test::IS_PUBLIC;
        $this->save();
    }

    public function toggleStatus($value)
    {   
        if($value == null) 
        {
            return $this->setDraft();
        }

        return $this->setPublic();
    }
}
