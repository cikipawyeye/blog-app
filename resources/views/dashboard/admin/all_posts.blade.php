@extends('dashboard.layouts.app')

@section('title', 'All Posts')

@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        @foreach ($breadcrumb as $page)
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">{{ $page }}</a></li>
        @endforeach
        {{-- <li class="breadcrumb-item text-sm text-dark active">Tables</li> --}}
    </ol>
    <h6 class="font-weight-bolder mb-0">Posts</h6>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @if (session('message'))
                <div class="alert alert-dark alert-dismissible fade show text-white" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>{{ session('message') }}!</strong> </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="/dashboard/all-posts"><button
                                    class="btn btn-outline-default {{ $tab == 'all' ? 'text-primary' : 'shadow-none text-dark' }}">All
                                    Posts ({{ $count['allPost'] }})</button></a>
                            <a href="/dashboard/active-posts"><button
                                    class="btn btn-outline-default {{ $tab == 'active' ? 'text-primary' : 'shadow-none text-dark' }}">Active
                                    Posts ({{ $count['activePost'] }})</button></a>
                            <a href="/dashboard/inactive-posts"><button
                                    class="btn btn-outline-default {{ $tab == 'inactive' ? 'text-primary' : 'shadow-none text-dark' }}">Nonactive
                                    ({{ $count['archivedPost'] }})</button></a>
                        </div>
                        <div class="col-md-6">
                            <form action="/dashboard/search" method="GET">
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
                        <table class="table align-items-center mb-0">
                            @if (count($posts) == 0)
                                <h5 class="text-center mt-4 mb-4">Nothing to show</h5>
                            @else
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center mx-auto">
                                            Status</th>
                                        <th
                                            class="ps-2 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Title</th>
                                        <th
                                            class="ps-3 text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created by</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Category</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date
                                        </th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Active
                                        </th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td class="ps-3 text-xs ">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    @if ($post->status == 'published')
                                                        <span class="badge bg-gradient-primary ">{{ $post->status }}</span>
                                                    @elseif ($post->status == 'archived')
                                                        <span class="badge bg-gradient-secondary">{{ $post->status }}</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 text-sm"><a
                                                        href="
                                                    @if ($post->status == 'published') /blog/{{ $post->slug }}
                                                    @else
                                                        /dashboard/contents/{{ $post->slug }} @endif"
                                                        target="_blank">{{ Str::limit($post->title, 80, '...') }}</a></h6>
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
                                                <p class="text-xs font-weight-bold mb-0">{{ $post->category->name }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold">{{ Str::limit($post->created_at, 10, '') }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <div class="d-flex form-check form-switch justify-content-center">
                                                    <input class="form-check-input flex-switch-check-default"
                                                        type="checkbox" id="flexSwitchCheckDefault{{ $loop->iteration }}"
                                                        data-bs-toggle="modal" data-bs-target="#modal-default"
                                                        {{ $post->status == 'published' ? 'checked' : '' }}
                                                        data-title="{{ $post->title }}" data-slug="{{ $post->slug }}"
                                                        onclick="postStatus('flexSwitchCheckDefault{{ $loop->iteration }}')">
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <a href="/posts/{{ $post->id }}/edit/"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    Edit
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="modal fade" id="modal-default" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-default">title</h6>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"
                            id="modal-btn-close" onclick="">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                    <form class="modal-footer" id="modal-post-url" action="#" method="POST">
                        @csrf
                        <button type="submit" class="btn bg-gradient-primary" id="btn-ok">Save changes</button>
                        <button type="button" class="btn btn-link ml-auto" id="modal-btn-cancel"
                            data-bs-dismiss="modal" onclick="">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        function postStatus(togglePostId) {
            const modalTitle = document.getElementById('modal-title-default');
            const modalBody = document.getElementById('modal-body');
            const modalBtnOk = document.getElementById('btn-ok');
            const url = document.getElementById('modal-post-url');

            const togglePost = document.getElementById(togglePostId);

            const postTitle = togglePost.getAttribute('data-title');
            const postSlug = togglePost.getAttribute('data-slug');

            if (!togglePost.checked) {
                modalTitle.innerHTML = "Disable Post";
                modalBody.innerHTML = `Do you want to disable "<strong>${postTitle}</strong>"?`;
                modalBtnOk.innerHTML = "Disable";
                url.setAttribute('action', `/dashboard/disable/${postSlug}`);
            } else {
                modalTitle.innerHTML = "Activate Post";
                modalBody.innerHTML = `Do you want to enable "<strong>${postTitle}</strong>"?`;
                modalBtnOk.innerHTML = "Enable";
                url.setAttribute('action', `/dashboard/enable/${postSlug}`);
            }

            const modalClose = document.getElementById('modal-btn-close');
            const modalCancel = document.getElementById('modal-btn-cancel');

            modalClose.setAttribute('onclick', `undoToggle('${togglePostId}')`)
            modalCancel.setAttribute('onclick', `undoToggle('${togglePostId}')`)

        }

        function undoToggle(toggleId) {
            const toggleElement = document.getElementById(toggleId);
            toggleElement.checked ? toggleElement.checked = false : toggleElement.checked = true;
        }
    </script>

@endsection
