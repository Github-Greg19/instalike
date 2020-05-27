<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    #How to make a default image
    public function profileImage()
    {
        $imagePath = ($this->image) ? '/storage/' . $this->image: 'https://cdn4.vectorstock.com/i/1000x1000/54/88/businessman-profile-colorful-vector-9685488.jpg';
        return $imagePath;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
