<?php

namespace App\Jobs;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use App\Mail\PostUpdatedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendPostUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $post;
    protected $currentUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post, User $currentUser)
    {
        $this->post = $post;
        $this->currentUser = $currentUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $author = $this->post->user;

        if (! ($this->currentUser->role == 'admin' && $this->currentUser->id == $author->id)) {
            $admin = User::where('role', 'admin')->first();

            if ($this->currentUser->role == 'admin' && $this->currentUser->id !== $author->id) {
                $recipient = $author;
                $actingUser = $admin;
            } elseif ($this->currentUser->id == $author->id) {
                $recipient = $admin;
                $actingUser = $author;
            }

            Mail::to($recipient)->send(new PostUpdatedEmail($recipient, $actingUser, $this->post));
        }
    }
}
