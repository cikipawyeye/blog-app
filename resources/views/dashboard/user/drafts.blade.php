@extends('dashboard.layouts.app')

@section('title', 'Drafts')

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show text-white" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text">{!! session('status') !!}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('message'))
        <div class="alert alert-dark alert-dismissible fade show text-white" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text"><strong>{{ session('message') }}</strong> </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row mb-3">
                        <div class="col-md-6 d-flex align-items-center">
                            {{-- <h6>All Drafts</h6> --}}
                            <span class="badge badge-sm bg-gradient-info">Draft</span>
                        </div>
                        <div class="col-md-6">
                            <form action="/dashboard/drafts/search" method="GET">
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
                                            Date
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>
                                                <h6 class="ps-3 mb-0 text-sm"><a
                                                        href="/dashboard/contents/{{ $post->slug }}">{{ Str::limit($post->title, 80, '...') }}</a>
                                                </h6>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{!! $post->category->name ?? '<span class="text-danger">Uncategorized</span>' !!}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ $post->updated_at }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <a href="/posts/{{ $post->id }}/edit"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit post">Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <h6 class="my-5 text-center">No draft post.</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
