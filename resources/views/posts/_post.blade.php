<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                <small>posted by <strong>{{ $post->user->name }}</strong></small>
                <small>in <em>{{ $post->category->name }}</em></small>
                <small>on {{ $post->created_at->format('d/m/Y H:i') }}</small>

                @can('update', $post)
                    <small><a href="{{ route('posts.edit', $post) }}">Edit</a></small>
                @endcan
            </div>
            <div class="card-body">
                <p>
                    {{ $post->preview }}
                </p>

                @if($full)
                    <p>
                        {{ $post->body }}
                    </p>
                @endif

            </div>
            <div class="card-footer">
                <small>Tags: <em>{{ $post->tags->pluck('name')->implode(', ') }}</em></small>
            </div>
        </div>
    </div>
</div>
<hr>
