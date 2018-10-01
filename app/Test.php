<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Test extends Model
{
    use Sluggable;

    const IS_DRAFT = 0;
    const IS_PUBLIC = 1;
    const IS_STANDART = 0;
    const IS_FEATURED = 1;

    protected $fillable = [
        'title', 'content', 'date', 'description', 'event_id'
    ];

	public function author()
    {
    	return $this->belongsTo(User::class, 'user_id');
    }

    public function event()
    {
    	return $this->belongsTo(Event::class);
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

    public static function add($fields)
    {
        $test = new static;
        $test->fill($fields);
        $test->user_id = 1;
        $test->save();

        return $test;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function remove()
    {
        $this->removeImage();
        $this->delete();
    }

    public function uploadImage($image)
    {   
        if($image == null) { return; }

        $this->removeImage();
        $filename = str_random(10) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function removeImage()
    {   
        if($this->image != null)
        {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function getImage()
    {
        if($this->image == null) 
        {
            return '/img/no-image.png';
        }

        return '/uploads/' . $this->image;
    }

    public function setEvent($id)
    {   
        if($id == null) { return; }

        $this->event_id = $id;
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

    public function setStandart()
    {   
        $this->is_featured = Test::IS_STANDART;
        $this->save();
    }

    public function setFeatured()
    {   
        $this->is_featured = Test::IS_FEATURED;
        $this->save();
    }

    public function toggleFeatured($value)
    {   
        if($value == null) 
        {
            return $this->setStandart();
        }

        return $this->setFeatured();
    }

    public function setDateAttribute($value)
    {
       $date = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
       
       $this->attributes['date'] = $date;
    }

    public function getDateAttribute($value)
    {
       $date = Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
       
       return $date;
    }

    public function getEventTitle()
    {
        return ($this->event != null)
            ? $this->event->title
            : 'Нет категории';
    }

    function getEventID()
    {
        return $this->event != null ? $this->event->id : null;
    }

    function getDate()
    {
       return Carbon::createFromFormat('d/m/Y', $this->date)->format('F d, Y');
    }

    function hasPrevious()
    {
        return self::where('id', '<', $this->id)->max('id');
    }

    function getPrevious()
    {
        $testID = $this->hasPrevious();

        return self::find($testID);
    }

    function hasNext()
    {
        return self::where('id', '>', $this->id)->min('id');
    }

    function getNext()
    {
        $testID = $this->hasNext();

        return self::find($testID);
    }

    function related()
    {
        return self::all()->except($this->id);
    }
}
