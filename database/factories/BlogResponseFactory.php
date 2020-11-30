<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\BlogResponse;
use Faker\Generator as Faker;

$factory->define(BlogResponse::class, function (Faker $faker) {
    $blog = factory(App\Blog::class)->create();
    return [
        'user_id' => $blog->user_id,
        'name' => $blog->name,
        'blog_id' => $blog->id,
        'content' => $faker->text($maxNbChars = 255),
    ];
});
