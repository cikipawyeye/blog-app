@extends('dashboard.layouts.app')

@section('title', 'My Posts')

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('message'))
                <div class="alert alert-dark alert-dismissible fade show text-white" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text">{!! session('message') !!} </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/dashboard/myposts"><button
                                    class="btn btn-outline-default {{ $tab == 'all' ? 'text-primary' : 'shadow-none text-dark' }}">All
                                    Posts ({{ $count['allPost'] }})</button></a>
                            <a href="/dashboard/my-active-posts"><button
                                    class="btn btn-outline-default {{ $tab == 'active' ? 'text-primary' : 'shadow-none text-dark' }}">Active
                                    Posts ({{ $count['activePost'] }})</button></a>
                            <a href="/dashboard/my-inactive-posts"><button
                                    class="btn btn-outline-default {{ $tab == 'inactive' ? 'text-primary' : 'shadow-none text-dark' }}">Nonactive
                                    ({{ $count['archivedPost'] }})</button></a>
                        </div>
                        <div class="col-md-6">
                            <form action="/dashboard/myposts/search" method="GET">
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-search"
                                            aria-hidden="true"></i></span>
                                    <input type="text" name="keyword" class="form-control" placeholder="Search post..."
                                        value="{{ Request::input('keyword') }}">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        @if (count($posts) > 0)
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Title
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Category</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                @if ($post->status === 'published')
                                                    <h6 class="ps-3 mb-0 text-sm"><a href="/blog/{{ $post->slug }}"
                                                            target="_blank">{{ $post->title }}</a></h6>
                                                @else
                                                    <h6 class="ps-3 mb-0 text-sm"><a
                                                            href="/dashboard/contents/{{ $post->slug }}">{{ $post->title }}</a>
                                                    </h6>
                                                @endif
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $post->category->name }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($post->status == 'published')
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $post->status }}</span>
                                                @elseif ($post->status == 'draft')
                                                    <span
                                                        class="badge badge-sm bg-gradient-info">{{ $post->status }}</span>
                                                @elseif ($post->status == 'revision')
                                                    <span
                                                        class="badge badge-sm bg-gradient-warning">{{ $post->status }}</span>
                                                @else
                                                    <span
                                                        class="badge badge-sm bg-gradient-dark">{{ $post->status }}</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h4 class="text-center my-5">Nothing here..</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
