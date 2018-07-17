<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Categories</div>
            <div class="card-body">
                <ul>
                    @foreach($categories as $category)
                        <li><a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a> ({{ $category->posts_count }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
