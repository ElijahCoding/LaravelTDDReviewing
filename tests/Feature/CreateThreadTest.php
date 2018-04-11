<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
      parent::setUp();
      $this->thread = create('App\Thread');
    }

    /** @test */
    public function guests_may_not_create_threads()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->post('/threads', $this->thread->toArray());
    }

    /** @test */
    public function guests_may_not_see_the_create_page()
    {
      $this->withExceptionHandling()
           ->get('/threads/create')
           ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
        $this->signIn();

        $this->post('/threads', $this->thread->toArray());

        $this->get($this->thread->path())
             ->assertSee($this->thread->title)
             ->assertSee($this->thread->body);
    }
}
