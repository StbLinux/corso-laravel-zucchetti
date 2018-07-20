<?php

namespace Tests\Feature;

use App\Tag;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostListingAndViewingTest extends TestCase
{
    use RefreshDatabase;

    protected $post;

    protected function setUp()
    {
        parent::setUp();

        $this->post = create(Post::class);
        $tags = create(Tag::class, 3);
        $this->post->tags()->sync($tags->pluck('id')->toArray());
        $this->post->load('user', 'category', 'tags');
    }

    /** @test */
    public function aUserCanSeePostListing()
    {
        //act - when
        $response = $this->get(route('posts.index'));

        //assert - then
        $response->assertSee($this->post->title);
        $response->assertSee($this->post->preview);
        $response->assertDontSee($this->post->body);
        $response->assertSee($this->post->category->name);
        $response->assertSee($this->post->user->name);
        //test tags
        foreach ($this->post->tags as $tag) {
            $response->assertSee($tag->name);
        }
    }

    /** @test */
    public function aUserCanSeeASinglePost()
    {
        // act
        $response = $this->get(route('posts.show', $this->post));

        // assert
        $response->assertSee($this->post->title);
        $response->assertSee($this->post->preview);
        $response->assertSee($this->post->body);
        $response->assertSee($this->post->category->name);
        $response->assertSee($this->post->user->name);
        //test tags
        foreach ($this->post->tags as $tag) {
            $response->assertSee($tag->name);
        }
    }
}
