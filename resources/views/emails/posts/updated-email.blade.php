@component('mail::message')
# Hello {{ $recipient->name }}

The post <strong>"{{ $post->title }}"</strong> was updated by {{ $actingUser->name }}. Please review it.

@component('mail::button', ['url' => route('posts.show', $post)])
See updated post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
