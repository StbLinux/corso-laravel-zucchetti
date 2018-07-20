<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function userHasPost()
    {
        //arrange
        $user = create(User::class);

        $posts = create(Post::class, 3, [
            'user_id' => $user->id,
        ]);

        //act
        $user->load('posts');

        //assert
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->posts);
        $this->assertInstanceOf(Post::class, $user->posts->first());
    }
}
