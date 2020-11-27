<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        factory(User::class)->create();
        $this->assertTrue(true);
    }
}
