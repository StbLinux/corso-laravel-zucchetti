<?php

namespace App\Listeners;

use App\Events\PostWasUpdated;
use App\Jobs\SendPostUpdateJob;

class SendEmailForUpdatedPostListener
{
    /**
     * Handle the event.
     *
     * @param  PostWasUpdated  $event
     *
     * @return void
     */
    public function handle(PostWasUpdated $event)
    {
        SendPostUpdateJob::dispatch($event->post, auth()->user());
    }
}
