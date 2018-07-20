<?php

namespace Tests\Feature;

use App\Tag;
use App\Post;
use App\User;
use App\Category;
use Tests\TestCase;
use App\Mail\PostUpdatedEmail;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostEditingAndDeletingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnauthenticatedUserCannotSeeEditingForm()
    {
        $this->enableExceptionHandling();
        //act
        $response = $this->get(route('posts.edit', 1));

        //assert
        $response->assertStatus(302);
        $response->assertLocation(route('login'));
    }

    /** @test */
    public function anAuthenticatedUserCanSeeEditingPostWithPostData()
    {
        //arrange
        $this->signIn();

        $post = create(Post::class, null, [
            'user_id' => auth()->id(),
        ]);

        //act
        $response = $this->get(route('posts.edit', $post));

        //assert
        $response->assertSee($post->title);
        $response->assertSee($post->preview);
        $response->assertSee($post->body);
    }

    /** @test */
    public function anAuthenticatedUserCanModifyPost()
    {
        //arrange
        list($post, $postData) = $this->createPost();

        //act
        $response = $this->patch(route('posts.update', $post), $postData);

        //assert
        //il post è stato modifcato del db
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Edited title',
            'preview' => 'Edited preview',
            'body' => 'Edited body',
            'category_id' => 2,
        ]);

        //l'immagine è stata caricata
        Storage::disk('covers')->assertExists('test_cover.jpg');

        //ha i tags giusti
        $post->load('tags');
        $this->assertSame([4, 5, 6], $post->tags->pluck('id')->toArray());

        //vogliamo vedere di essere indirizzati nella view singolo post
        $response->assertStatus(302);
        $response->assertRedirect(route('posts.show', $post->fresh()));

        //vogliamo vedere un messaggio di Success in sessione
        $response->assertSessionHas(['notice']);
    }
    //event
    //mail

    /** @test */
    public function emailIsSentAdminOnPostUpdateByUser()
    {
        // Mail::fake();

        //arrange
        list($post, $postData) = $this->createPost();

        $admin = create(User::class, null, [
            'role' => 'admin',
        ]);

        //act
        $response = $this->patch(route('posts.update', $post), $postData);

        //assert
        Mail::assertSent(PostUpdatedEmail::class, function ($mail) use ($admin) {
            return $mail->hasTo($admin->email);
        });
    }

    /** @test */
    public function emailIsSentToUserOnPostUpdateByAdmin()
    {
        Mail::fake();

        $admin = create(User::class, null, [
            'role' => 'admin',
        ]);

        //arrange
        list($post, $postData) = $this->createPost($admin);

        //act
        $response = $this->patch(route('posts.update', $post), $postData);

        //assert
        Mail::assertSent(PostUpdatedEmail::class, function ($mail) use ($admin) {
            $mail->build();
            return $mail->hasTo(User::find(2)->email) && $mail->subject('A post has been updated. Please review.');
        });
    }

    private function createPost($user = null)
    {
        Storage::fake('covers');

        $this->signIn($user);

        $category = create(Category::class, 2);
        $tags = create(Tag::class, 6);

        $post = create(Post::class, null, [
            'user_id' => ($user) ? create(User::class)->id : auth()->id(),
            'category_id' => 1,
        ]);

        $post->tags()->sync([1, 2, 3]);

        $postData = [
            'title' => 'Edited title',
            'preview' => 'Edited preview',
            'body' => 'Edited body',
            'category_id' => 2,
            'cover' => UploadedFile::fake()->image('test_cover.jpg'),
            'tags' => [4, 5, 6],
        ];

        return [$post->fresh(), $postData];
    }


    /** @test */
    public function onlyAnAdminCanDeleteAPost()
    {
        //arrange
        $admin = create(User::class, null, [
            'role' => 'admin',
        ]);

        $this->signIn($admin);

        $post = create(Post::class, null, [
            'user_id' => auth()->id(),
        ]);

        //act
        $response = $this->delete(route('posts.destroy', $post));

        //assert
        $this->assertDatabaseMissing('posts', ['id' => 1]);
    }

    /** @test */
    public function onlyAuthorCanUpdateOwnPost()
    {
        $this->enableExceptionHandling();
        //arrange
        list($post, $postData) = $this->createPost(create(User::class));

        //act
        $response = $this->patch(route('posts.update', $post), $postData);

        //assert
        $response->assertStatus(403);
    }
}
