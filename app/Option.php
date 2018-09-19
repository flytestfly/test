<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{

	const IS_DRAFT = 0;
    const IS_PUBLIC = 1;

	protected $fillable = [
        'option'
    ];

    public function author()
    {
    	return $this->hasOne(User::class);
    }

    public function question()
    {
    	return $this->hasOne(Question::class);
    }

    public static function add($fields)
    {
        $option = new static;
        $option = fill($fields);
        $option = save();

        return $option;
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

    public function setQuestion($id)
    {   
        if($id == null) { return; }

        $this->question_id = $id;
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
