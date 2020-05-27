<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded= []; // Do not guard anything.

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
