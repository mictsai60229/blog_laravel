<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class SlackTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        Log::critical('This is a critical message sent from Laravel App');
        $this->assertTrue(true);
    }
}
