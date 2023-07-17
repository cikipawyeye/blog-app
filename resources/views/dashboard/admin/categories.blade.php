@extends('dashboard.layouts.app')

@section('title', 'Post Categories')

@section('content')

    <div class="row">
        <div class="col-12">
            @if (session('message'))
                <div class="alert alert-dark alert-dismissible fade show text-white" role="alert">
                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                    <span class="alert-text"><strong>{{ session('message') }}</strong> </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($errors->has('have-post'))
                <div class="alert alert-warning  alert-dismissible fade show" role="alert">
                    <span class="alert-icon text-white"><i class="fa fa-exclamation-circle"></i>
                        <span class="alert-text text-white"> {{ $errors->get('have-post')[0] }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Categories table</h6>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-form">New
                                Category</button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Category Name</th>
                                    <th
                                        class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Active Posts</th>
                                    <th
                                        class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <h6 class="ps-3 mb-0 text-sm">{{ $category->name }}</h6>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">
                                                {{ count($category->posts->where('status', 'published')) }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <button class="border-0 bg-white">
                                                <a href="/categories/{{ $category->id }}/edit"
                                                    class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                                                    data-original-title="Edit user">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </a>
                                            </button>
                                            <button class="text-danger border-0 bg-white font-weight-bold text-xs"
                                                data-bs-toggle="modal" data-bs-target="#modal-notification"
                                                onclick="deleteCategory({{ $category->id }},
                                                '{{ $category->name }}')">
                                                <i class="fa fa-trash" aria-hidden="true"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h6 class="font-weight-bolder text-primary text-gradient">New Category</h6>
                                </div>
                                <div class="card-body">
                                    <form role="form text-left" action="/categories" method="POST">
                                        @csrf
                                        <label>Name</label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Insert category name"
                                                aria-label="Name" name="name" required>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-round bg-gradient-primary btn-lg w-100 mt-4 mb-0">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog"
                aria-labelledby="modal-notification" aria-hidden="true">
                <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
                            <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="py-3 text-center">
                                <i class="ni ni-bell-55 ni-3x"></i>
                                <h4 class="text-gradient text-danger mt-4">You should read this!</h4>
                                <p>Are you sure you want to remove the "<span class="text-dark"
                                        id="category-name">category-name</span>" category? The category to be deleted must
                                    have <strong>no posts</strong>.
                                </p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link text-dark me-auto"
                                data-bs-dismiss="modal">Close</button>
                            <form action="" id="form-delete" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn text-danger btn-white">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function deleteCategory(id, categoryName) {
            console.log('delete category' + id + categoryName);
            const name = document.getElementById('category-name');
            const form = document.getElementById('form-delete');

            name.innerHTML = categoryName;
            form.setAttribute("action", "/categories/" + id);
        }
    </script>
@endsection
