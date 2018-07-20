<?php

namespace Tests\Feature;

use App\Tag;
use App\Post;
use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnauntheticatedUserCannotSeeCreationForm()
    {
        $this->enableExceptionHandling();
        //act
        $response = $this->get(route('posts.create'));

        //assert
        $response->assertStatus(302);
        $response->assertLocation(route('login'));
    }

    /** @test */
    public function anAuthenticatedUserCanSeePostCreationForm()
    {
        $this->signIn();

        //act
        $response = $this->get(route('posts.create'));

        //assert
        $response->assertStatus(200);
        $response->assertSee('Create a new post');
    }

    /** @test */
    public function anAuthenticatedUserCanCreatePost()
    {
        $category_id = create(Category::class)->id;
        create(Tag::class, 3);
        //arrange
        $this->signIn();
        $postData = [
            'title' => 'Test post',
            'category_id' => $category_id,
            'preview' => 'Test preview',
            'body' => 'Test body',
            'tags' => [1, 2, 3],
        ];

        //act
        $response = $this->post(route('posts.store'), $postData);

        $post = Post::with('user', 'category', 'tags')->first();

        //assert
        // il post è stato creato
        $this->assertDatabaseHas('posts', [
            'title' => 'Test post',
            'category_id' => $category_id,
            'preview' => 'Test preview',
            'body' => 'Test body',
        ]);

        // id dell autore è id dell'utente corrente
        $this->assertEquals($post->user->id, auth()->id());

        // il post ha la categoria giusta
        $this->assertEquals($post->category->id, $postData['category_id']);

        // il post ha i tags giusti
        $this->assertSame([1, 2, 3], $post->tags->pluck('id')->toArray());

        // siamo stati reindirizzati alla pagina visione post
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.show', $post));
    }

    /** @test */
    public function postCreationHasMandatoryFields()
    {
        $this->signIn()->enableExceptionHandling();

        // arrange
        $postData = [];

        //act
        $response = $this->post(route('posts.store'), $postData);

        //assert
        //ci sono errori
        $response->assertSessionHasErrors(['title']);
        $response->assertSessionHasErrors(['category_id']);
        $response->assertSessionHasErrors(['preview']);
        $response->assertSessionHasErrors(['body']);
    }
}
