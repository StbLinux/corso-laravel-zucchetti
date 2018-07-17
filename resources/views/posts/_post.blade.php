<div class="row">
    <div class="col-md-12">
        <div class="card">
            <img src="{{ $post->cover }}" style="width: 100%">
            <div class="card-header">
                <h5><a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a></h5>
                <small>posted by <strong>{{ $post->user->name }}</strong></small>
                <small>in <em><a href="{{ route('categories.show', $post->category) }}">{{ $post->category->name }}</a></em></small>
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
                <small><em>{!! $post->tagLinks() !!}</em></small>
            </div>
        </div>
    </div>
</div>
<hr>
