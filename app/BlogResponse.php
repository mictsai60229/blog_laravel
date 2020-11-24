<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogResponse extends Model
{
    //    
    protected $fillable = [
        'name', 'content',
    ];

    protected $table = 'blog_responses';
    protected $primaryKey = 'id';
}
