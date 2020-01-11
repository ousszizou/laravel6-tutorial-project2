@extends('layouts.app')

@section('stylesheets')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? "Update Post" : "Add a new Post" }}
        </div>
        <div class="card-body">
        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                  @method('PUT')
                @endif
                <div class="form-group">
                    <label for="post title">Title:</label>
                <input type="text" class="form-control" name="title" placeholder="Add a new post" value="{{ isset($post) ? $post->title : "" }}">
                </div>
                <div class="form-group">
                    <label for="post description">Description:</label>
                    <textarea class="form-control" rows="2" name="description" placeholder="Add a description">{{ isset($post) ? $post->description : "" }}</textarea>
                </div>
                <div class="form-group">
                    <label for="post content">content:</label>
                    {{-- <textarea class="form-control" rows="3" name="content" placeholder="Add a content"></textarea> --}}
                    <input id="x" type="hidden" name="content" value="{{ isset($post) ? $post->content : "" }}">
                    <trix-editor input="x"></trix-editor>
                </div>
                @if (isset($post))
                  <div class="form-group">
                    <img src="{{asset('storage/' . $post->image)}}" style="width: 100%" />
                  </div>
                @endif
                <div class="form-group">
                    <label for="post image">Image:</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group">
                  <label for="selectCategory">Select a category</label>
                  <select name="categoryID" class="form-control" id="selectCategory">
                    @foreach ($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                @if (!$tags->count() <= 0 && isset($post))
                  <div class="form-group">
                    <label for="selectTag">Select a tag</label>
                    <select name="tags[]" class="form-control tags" id="selectTag" multiple>
                      @foreach ($tags as $tag)
                        <option value="{{$tag->id}}"
                          @if ($post->hasTag($tag->id))
                            selected
                          @endif
                          >
                          {{$tag->name}}
                        </option>
                      @endforeach
                    </select>
                  </div>
                @endif
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        {{ isset($post) ? "Update" : "Add" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
      $(document).ready(function() {
        $('.tags').select2();
      });
    </script>
@endsection
