@extends('dashboard.layouts.app-no-sidebar')

@section('title', 'Post title')

@section('head')
    <style>
        .article-container {
            color: rgb(42, 43, 50);
        }

        .article-container div,
        img {
            margin: 20px 0px;
        }

        .article-container h1 {
            margin: 40px 0px 10px 0;
            color: rgb(42, 43, 50);
            font-size: 24px;
        }

        .article-container ol,
        ul {
            /* margin: 20px 0px 0px 40px; */
        }

        .article-container a {
            text-decoration: none;
            color: rgba(173, 32, 34, 0.902);
        }

        .article-container blockquote {
            margin: 20px 0px;
            padding: 30px;
            /* background-color: rgb(238, 238, 238);
                                    border-radius: 20px; */
            font-style: italic;
            border-left: 8px solid rgb(220, 221, 255);
        }

        .article-container pre {
            margin: 20px 0px;
            padding: 20px;
            overflow: scroll;
            background-color: rgb(238, 238, 238);
            border-radius: 5px;
        }
    </style>
@endsection

@section('content')

    <div class="mx-auto" style="width: 90%; max-width: 800px">
        @if ($post->status == 'draft')
            <span class="badge bg-gradient-info">{{ $post->status }}</span><br><br>
        @elseif($post->status == 'revision')
            <span class="badge bg-gradient-warning">{{ $post->status }}</span> <br><br>
        @elseif($post->status == 'archived')
            <span class="badge bg-gradient-dark">{{ $post->status }}</span><br><br>
        @else
            <span class="badge bg-gradient-primary">{{ $post->status }}</span><br><br>
        @endif
        <table>
            <tr>
                <td>Writer</td>
                <td>&emsp;:&emsp;</td>
                <td>
                    @php
                        $person = [];
                        foreach ($post->users as $value) {
                            array_push($person, $value->name);
                        }
                        echo implode(', ', $person);
                    @endphp
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>&emsp;:&emsp;</td>
                <td>{!! $post->category->name ?? '<span class="text-danger">Uncategorized</span>' !!}</td>
            </tr>
            <tr>
                <td>Description/note</td>
                <td>&emsp;:&emsp;</td>
                <td>{{ $post->description }}</td>
            </tr>
            <tr>
                <td>Date</td>
                <td>&emsp;:&emsp;</td>
                <td>{{ $post->created_at }}</td>
            </tr>
            <tr>
                <td>Accepted By</td>
                <td>&emsp;:&emsp;</td>
                @if (!is_null($post->accBy))
                    <td>{{ $post->accBy->name }}</td>
                @else
                    <td>-</td>
                @endif
            </tr>
            <tr>
                <td>Revision note</td>
                <td>&emsp;:&emsp;</td>
                <td>{{ $post->revision_note }}</td>
            </tr>
        </table>

        <article class="my-5 article-container">
            <h5 class="fs-2"> {{ $post->title }} </h5>
            @if ($post->banner_url != null)
                <img src="/storage/{{ $post->banner_url }}" alt="" width="50%">
            @endif

            {!! $post->post !!}
        </article>
    </div>

    @if (Auth::user()->role == 'admin')
        <div class="d-flex justify-content-center">
            @if ($post->status == 'published')
                <a href="/posts/{{ $post->id }}/edit" class="btn btn-block bg-gradient-primary mb-3 mx-1">Edit</a>
            @elseif ($post->category)
                <button type="button" class="btn btn-block bg-gradient-primary mb-3 mx-1" data-bs-toggle="modal"
                    data-bs-target="#modal-default">Publish</button>
            @endif
            <button type="button" class="btn bg-gradient-default btn-block mb-3 mx-1" data-bs-toggle="modal"
                data-bs-target="#exampleModalMessage">
                Revision
            </button>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modal-default"
                    aria-hidden="true">
                    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title" id="modal-title-default">Publish post</h6>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p><strong>{{ $post->title }}</strong> will be displayed publicly.</p>
                            </div>
                            <div class="modal-footer">
                                <form action="/dashboard/publish/{{ $post->slug }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn bg-gradient-primary">Publish</button>
                                </form>
                                <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModalMessage" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" role="dialog" aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Post revision</h5>
                                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <form action="/dashboard/revision/{{ $post->slug }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name" class="col-form-label">Send revision to:</label><br>
                                        {{-- <input type="text" class="form-control" value="Creative Tim" id="recipient-name"> --}}
                                        <p class="ms-1">@php
                                            $person = [];
                                            foreach ($post->users as $value) {
                                                array_push($person, $value->name);
                                            }
                                            echo implode(', ', $person);
                                        @endphp</p>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Revision note:</label>
                                        <textarea class="form-control" name="revision-note" id="message-text">{{ $post->revision_note }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn bg-gradient-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn bg-gradient-primary">Send</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endsection
