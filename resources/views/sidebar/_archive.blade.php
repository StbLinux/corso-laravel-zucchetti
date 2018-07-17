<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Archive</div>
            <div class="card-body">
                <ul>
                    @foreach($archive as $record)
                        <li><a href="{{ route('posts.index') }}?month={{ $record->month }}&year={{ $record->year }}">{{ $record->month }} {{ $record->year }}</a> ({{ $record->published }})</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
