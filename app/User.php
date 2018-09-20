<?php

namespace App;

use \Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const IS_NORMAL = 0;
    const IS_ADMIN = 1;

    const IS_ANBAN = 0;
    const IS_BAN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function tests()
    {
        return $this->hasMany(Test::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public static function add($fields)
    {
        $user = new static;
        $user->fill($fields);
        $user->save();

        return $user;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function generatePassword($password)
    {
        if($password != null)
        {
            $this->password = bcrypt($password);
            $this->save();
        }
    }

    public function remove()
    {
        $this->removeAvatar();
        $this->delete();
    }

    public function uploadAvatar($image)
    {   
        if($image == null) { return; }

        $this->removeAvatar();
        $filename = str_random(11) . '.' . $image->extension();
        $image->storeAs('uploads', $filename);
        $this->image = $filename;
        $this->save();
    }

    public function removeAvatar()
    {   
        if($this->image != null)
        {
            Storage::delete('uploads/' . $this->image);
        }
    }

    public function getAvatar()
    {
        if($this->image == null) 
        {
            return '/img/no-avatar.png';
        }

        return '/uploads/' . $this->image;
    }

    public function makeNormal()
    {   
        $this->status = User::IS_NORMAL;
        $this->save();
    }

    public function makeAdmin()
    {   
        $this->status = User::IS_ADMIN;
        $this->save();
    }

    public function toggleAdmin($value)
    {   
        if($value == null) 
        {
            return $this->makeNormal();
        }

        return $this->makeAdmin();
    }

    public function setBan()
    {   
        $this->status = User::IS_BAN;
        $this->save();
    }

    public function setAnBan()
    {   
        $this->status = User::IS_ANBAN;
        $this->save();
    }

    public function toggleBan($value)
    {   
        if($value == null) 
        {
            return $this->setAnBan();
        }

        return $this->setBan();
    }
}
