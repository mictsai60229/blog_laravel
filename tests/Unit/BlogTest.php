<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Blog;

class BlogTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        for ($i=0;$i<25;$i++){
            factory(Blog::class)->create();
        }
        $this->assertTrue(true);
    }
}
