<?php

namespace App\Mail;

use App\Post;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostUpdatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipient;
    public $actingUser;
    public $post;

    /**
     * Create a new message instance.
     *
     * @param App\User $recipient
     * @param App\User $actingUser
     * @param App\Post $post
     *
     * @return void
     */
    public function __construct(User $recipient, User $actingUser, Post $post)
    {
        $this->recipient = $recipient;
        $this->actingUser = $actingUser;
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('A post has been updated. Please review.')->markdown('emails.posts.updated-email');
    }
}
