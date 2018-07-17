<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Tags</div>
            <div class="card-body">
                    @foreach($tags as $tag)
                        <span style="font-size: {{ $tag->posts_count * 1.3 }}px">
                            <a href="{{ route('tags.show', $tag) }}">{{ $tag->name }}</a> ({{ $tag->posts_count }})
                        </span>
                    @endforeach
            </div>
        </div>
    </div>
</div>
