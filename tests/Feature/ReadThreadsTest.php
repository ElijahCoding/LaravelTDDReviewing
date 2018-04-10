<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;
    
    public function setUp()
    {
      parent::setUp();

      $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_user_can_browse_threads()
    {

        $response = $this->get('/threads');

        $response->assertSee($this->thread->title)
                 ->assertSee($this->thread->body);
    }

    /** @test */
    public function a_user_can_browse_a_single_thread()
    {
      $response = $this->get('/threads/' . $this->thread->id);

      $response->assertSee($this->thread->title)
               ->assertSee($this->thread->body);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
      $reply = create('App\Reply', ['thread_id' => $this->thread->id]);

      $this->get('/threads/' . $this->thread->id)
           ->assertSee($reply->body);
    }

}
