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
    @if ($errors->has('category'))
                <div class="alert alert-warning alert-dismissible fade show text-white" role="alert">
                    <span class="alert-icon"><i class="fa fa-exclamation-circle"></i></span>
                    <span class="alert-text"><strong>{{ $errors->get('category')[0] }}!</strong> </span>
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
                            <h6>All Drafts</h6>
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
                                            class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Author
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
                                                <div class="d-flex px-2 py-1">
                                                    {{-- <div>
                                                    <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3"
                                                        alt="user1">
                                                </div> --}}
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $post->creator->name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $post->creator->email }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{!! $post->category->name ?? '<span class="text-danger">Uncategorized</span>' !!}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ Str::limit($post->updated_at, 10, '') }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if ($post->status == 'draft')
                                                    <span class="badge bg-gradient-info">{{ $post->status }}</span>
                                                @else
                                                    <span class="badge bg-gradient-warning">{{ $post->status }}</span>
                                                @endif
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
