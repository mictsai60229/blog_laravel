<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\BlogResponse;
use App\Blog;

class DeleteBlogTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testDeleteExample()
    {
        
        $blog_response = factory(BlogResponse::class)->create();
        $blog = Blog::findOrFail($blog_response->blog_id);
        $blog->delete();
        
        $this->assertTrue(true);
    }
}
