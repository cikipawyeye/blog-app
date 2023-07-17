@extends('dashboard.layouts.app')

@section('title', 'New Category')

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
    <form class="form" action="/categories/{{ $category->id }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput2">Name
                @error('name')
                    <span class="text-xs text-danger">*required</span>
                @enderror
            </label>
            <input name="name" type="text" value="{{ $category->name }}"
                class="form-control  @error('name') is-invalid @enderror" id="exampleFormControlInput2"
                placeholder="Category name...">
        </div>
        <button type="submit" class="btn btn-outline-dark">Update</button>
    </form>
@endsection
