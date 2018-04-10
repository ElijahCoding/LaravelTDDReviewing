<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_browse_threads()
    {
        $thread = create('App\Thread');

        $response = $this->get('/threads');

        $response->assertSee($thread->title)
                 ->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_browse_a_single_thread()
    {
      $thread = create('App\Thread');

      $response = $this->get('/threads/' . $thread->id);

      $response->assertSee($thread->title)
               ->assertSee($thread->body);
    }

}
