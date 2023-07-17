@extends('dashboard.layouts.app')

@section('title', 'Drafts')

@section('head')
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>

    <style>
        .editor {
            color: rgb(42, 43, 50);
        }

        .editor div,
        .editor img {
            margin: 20px 0px;
        }

        .editor h1 {
            margin: 40px 0px 10px 0;
            color: rgb(42, 43, 50);
            font-size: 24px;
        }

        .editor ol,
        .editor ul {
            /* margin: 20px 0px 0px 40px; */
        }

        .editor a {
            text-decoration: none;
            color: rgba(173, 32, 34, 0.902);
        }

        .editor blockquote {
            margin: 20px 0px;
            padding: 30px;
            /* background-color: rgb(238, 238, 238);
                                    border-radius: 20px; */
            font-style: italic;
            border-left: 8px solid rgb(220, 221, 255);
        }

        .editor pre {
            margin: 20px 0px;
            padding: 20px;
            overflow: scroll;
            background-color: rgb(238, 238, 238);
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')
    <form class="form" action="/posts/{{ $post->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleFormControlInput1">Revision Note</label>
            <p class="text-sm ms-1 @error('img_banner') text-danger @enderror">{{ $post->revision_note }}</p>
        </div>
        @if (Auth::user()->role === 'admin')
            <div class="form-group">
                <label for="exampleFormControlInput3">Status
                    @error('status')
                        <span class="text-xs text-danger">*required</span>
                    @enderror
                </label>
                <select name="status" class="form-control @error('title') is-invalid @enderror"
                    id="exampleFormControlInput3">
                    <option>-- Select status --</option>
                    <option {{ $post->status == 'published' ? 'selected' : '' }} value="published">
                        Published
                    </option>
                    <option {{ $post->status == 'draft' ? 'selected' : '' }} value="draft">
                        Draft
                    </option>
                    <option {{ $post->status == 'revision' ? 'selected' : '' }} value="revision">
                        Revision
                    </option>
                    <option {{ $post->status == 'archived' ? 'selected' : '' }} value="archived">
                        Archived
                    </option>
                </select>
            </div>
        @else
            <div class="form-group">
                <label for="exampleFormControlInput1">Content Status</label><br>
                @if ($post->status == 'published')
                    <span class="badge badge-sm bg-gradient-success">{{ $post->status }}</span>
                @elseif ($post->status == 'draft')
                    <span class="badge badge-sm bg-gradient-info">{{ $post->status }}</span>
                @elseif ($post->status == 'revision')
                    <span class="badge badge-sm bg-gradient-warning">{{ $post->status }}</span>
                @else
                    <span class="badge badge-sm bg-gradient-dark">{{ $post->status }}</span>
                @endif
            </div>
        @endif
        <div class="form-group">
            <label for="exampleFormControlInput1">Image/Banner 2:1</label>
            @if ($post->banner_url != null)
                <img id="output" src="/storage/{{ $post->banner_url }}" alt="your image" width="30%"
                    class="my-2 d-block" />
                <div class="" id="remove-banner">
                    <input type="checkbox" id="rm-banner" name="rm-banner" value="true">
                    <label for="rm-banner">Remove Banner</label><br>
                </div>
            @else
                <img id="output" src="#" alt="your image" width="30%" class="my-2 d-none" />
            @endif
            <input name="img" type="file" accept=".jpg,.png,.webp,.jpeg"
                class="form-control @error('img') is-invalid @enderror" id="exampleFormControlInput1"
                onchange="loadFile(event)" placeholder="article description..."
                value="{{ asset('storage' . $post->banner_url) }}">
            <p class="text-xs ms-1 @error('img') text-danger @enderror">Max size: 2 MB @error('img')
                    , {{ $message }}
                @enderror
            </p>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Title
                @error('title')
                    <span class="text-xs text-danger">*required</span>
                @enderror
            </label>
            <input name="title" type="text" value="{{ $post->title }}"
                class="form-control  @error('title') is-invalid @enderror" id="exampleFormControlInput2"
                placeholder="Article title...">
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput3">Category
                @error('category')
                    <span class="text-xs text-danger">*required</span>
                @enderror
            </label>
            <select name="category" class="form-control @error('category') is-invalid @enderror"
                id="exampleFormControlInput3">
                <option>-- Select category --</option>
                @foreach ($categories as $category)
                    <option {{ isset($post->category->id) && $post->category->id == $category->id ? 'selected' : '' }} value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput4">Description</label>
            <input name="description" type="text" value="{{ $post->description }}" class="form-control"
                id="exampleFormControlInput4" placeholder="Description/note...">
        </div>
        <div class="form-group">
            <label for="x">Content
                @error('content')
                    <span class="text-xs text-danger">*required</span>
                @enderror
            </label>
            <div class="content-container">
                <input id="x" type="hidden" name="content" value="{{ $post->post }}">
                <trix-editor class="editor" input="x" placeholder="write your content..."></trix-editor>
            </div>
        </div>
        @if (Auth::user()->role === 'admin' && $post->status == 'published' 
        || $post->status == 'archived')
            <button type="submit" class="btn btn-outline-dark">Save</button>
        @else
            <button type="submit" class="btn btn-outline-dark">Save to draft</button>
        @endif
    </form>
@endsection

@section('script')

    <script>
        let loadFile = function(event) {
            let output = document.getElementById('output');
            let rmbanner = document.getElementById('remove-banner');
            try {
                output.classList.remove("d-none");
                output.style.display = 'block';
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src); // free memory
                }
                
                @if ($post->banner_url)
                    rmbanner.style.display = 'none';
                @endif
            } catch (error) {
                console.log(error.message);
                output.classList.remove("d-block");

                @if (!$post->banner_url)
                    output.style.display = 'none';
                    output.src = '#';
                @else
                    rmbanner.style.display = '';
                    output.src = '/storage/{{ $post->banner_url }}';
                @endif
            }
        };
    </script>

@endsection
