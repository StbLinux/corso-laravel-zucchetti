<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // 20 Category
        $categories = factory(App\Category::class, 20)->create();
        // 40 Tag
        $tags = factory(App\Tag::class, 40)->create();

        // 10 User
        factory(App\User::class)->create([
            'name' => 'Sid',
            'email' => 'forge405@gmail.com',
            'role' => 'admin',
            'password' => bcrypt(env('INITIAL_PASS', 'secret')),
        ]);
        factory(App\User::class, 9)->create();

        // 10 User
        $users = App\User::all();

        // Ciascun User 15 Post
        foreach ($users as $user) {
            // Ciascun Post 1 Category random tra quelle create
            $posts = factory(App\Post::class, 15)->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);

            foreach ($posts as $post) {
                // Ciascun Post 3 Tag random tra quelli creati
                // prendere 3 tag random
                // estrarre id di quest 3 random tag
                // associare ciascun id al post
                $post->tags()->sync($tags->random(3)->pluck('id')->toArray());
            }
        }
    }
}
