<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
      parent::setUp();
      $this->thread = create('App\Thread');
    }

    /** @test */
    public function a_thread_has_many_replies()
    {
      $thread = create('App\Thread');
      $reply = create('App\Reply', ['thread_id' => $thread->id]);

      $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    /** @test */
    public function a_thread_has_a_creator()
    {
      $thread = create('App\Thread');
      $this->assertInstanceOf('App\User', $thread->creator);
    }
}
