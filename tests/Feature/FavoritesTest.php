<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guests_can_not_favorite_anything()
    {
      $this->withExceptionHandling();

      $reply = create('App\Reply');

      $this->post('replies/' . $reply->id . '/favorites')
           ->assertRedirect('/login');

    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->signIn();
        
        $reply = create('App\Reply'); // automatically generating a thread . Read ModelFactory.php

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }
}
