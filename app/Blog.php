<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $fillable = [
        'name', 'title', 'content',
    ];

    protected $table = 'blogs';
    protected $primaryKey = 'id';
}
