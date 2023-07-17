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
    {{-- error message --}}
    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                <span class="alert-icon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                <span class="alert-text">{{ $error }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif --}}
    <form class="form" action="/posts" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Image/Banner 2:1</label>
            <img id="output" src="" alt="your image" width="20%" class="my-2 d-none" />
            <input name="img" type="file" onchange="loadFile(event)" accept="image/*"
                class="form-control  @error('img') is-invalid @enderror" id="exampleFormControlInput1"
                placeholder="article description...">
            <p class="text-xs ms-1 @error('img') text-danger @enderror">Max size: 2 MB</p>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Title
                @error('title')
                    <span class="text-xs text-danger">*required</span>
                @enderror
            </label>
            <input name="title" type="text" value="{{ old('title') }}"
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
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput4">Description</label>
            <input name="description" type="text" value="{{ old('description') }}" class="form-control"
                id="exampleFormControlInput4" placeholder="Description/note...">
        </div>
        <div class="form-group">
            <label for="x">Content
                @error('content')
                    <span class="text-xs text-danger">*required</span>
                @enderror
            </label>
            <div class="content-container">
                <input id="x" type="hidden" name="content" value="{{ old('content') }}">
                <trix-editor class="editor" input="x" placeholder="write your content..."></trix-editor>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-dark">Save to draft</button>
    </form>
@endsection

@section('script')

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.classList.remove("d-none"); 
            output.style.display = 'block';
            try {
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            } catch (error) {
                output.style.display = 'none';
                output.src = '#'
            }
        };
    </script>

@endsection
