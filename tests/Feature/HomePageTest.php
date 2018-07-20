<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function homePageWorks()
    {
        // arrange = given
        // act = when
        // carichiamo la home - /
        $response = $this->get(route('posts.index'));
        // assert - then
        // il codice è 200
        $response->assertStatus(200);
        // vediamo Latest Posts
        $response->assertSee('Latest Posts');
    }
}
