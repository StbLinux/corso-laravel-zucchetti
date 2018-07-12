<div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ old('title', $post->title) }}">

        @include('layouts.validation_feedback', ['field' => 'title'])
    </div>

    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}">
            <option></option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @if($category->id == old('category_id', $post->category_id)) selected="" @endif >{{ $category->name }}</option>
            @endforeach
        </select>

        @include('layouts.validation_feedback', ['field' => 'category_id'])
    </div>

    <div class="form-group">
        <label for="preview">Preview</label>
        <textarea class="form-control{{ $errors->has('preview') ? ' is-invalid' : '' }}" name="preview">{{ old('preview', $post->preview) }}</textarea>

        @include('layouts.validation_feedback', ['field' => 'preview'])
    </div>

    <div class="form-group">
        <label for="body">Post body</label>
        <textarea class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" rows="7">{{ old('body', $post->body) }}</textarea>

        @include('layouts.validation_feedback', ['field' => 'body'])
    </div>

    <div class="form-group">
        <label for="tags[]">Tags</label>
        <select name="tags[]" class="form-control{{ $errors->has('tags') ? ' is-invalid' : '' }}" multiple="">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}"
                    @if(in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray()))) selected="" @endif
                >{{ $tag->name }}</option>
            @endforeach
        </select>

        @include('layouts.validation_feedback', ['field' => 'tags'])
    </div>
