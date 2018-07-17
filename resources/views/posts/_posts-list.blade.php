@foreach($posts as $post)
    @include('posts._post', ['full' => false])
@endforeach

<div class="row">
    <div class="col-md-12">
        {{ $posts->links() }}
    </div>
</div>
