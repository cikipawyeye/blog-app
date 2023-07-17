@extends('dashboard.layouts.app')

@section('title', 'Create User')

@section('content')
    {{-- error message --}}
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                <span class="alert-icon"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                <span class="alert-text">{{ $error }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    @endif
    <form class="form" action="/users/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleFormControlInput2">Name
            </label>
            <span class="text-xs @error('name') text-danger @enderror">*required</span>
            <input name="name" type="text" value="{{ $user->name }}"
                class="form-control  @error('name') is-invalid @enderror" id="exampleFormControlInput2"
                placeholder="Insert user name..." required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Email
            </label>
            <span class="text-xs @error('email') text-danger @enderror">*required</span>
            <input name="email" type="email" value="{{ $user->email }}"
                class="form-control  @error('email') is-invalid @enderror" id="exampleFormControlInput2"
                placeholder="Insert user email..." required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Password
            </label>
            <span class="text-xs @error('password') text-danger @enderror">*leave blank if not changed, password minimum 8 characters, contain letter and
                number. </span>
            <input name="password" type="password" class="form-control  @error('password') is-invalid @enderror"
                id="exampleFormControlInput2" placeholder="Insert new user password or leave blank">
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="exampleFormControlInput2">Role</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="exampleRadios1" value="user"
                        {{ $user->role != 'admin' ? 'checked' : '' }}>
                    <label class="form-check-label" for="exampleRadios1">
                        User
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="role" id="exampleRadios2" value="admin"
                        {{ $user->role == 'admin' ? 'checked' : '' }}>
                    <label class="form-check-label" for="exampleRadios2">
                        Admin
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Phone Number
            </label>
            <span class="text-xs @error('phone') text-danger @enderror">*required</span>
            <input name="phone" type="number" value="{{ $user->phone }}"
                class="form-control  @error('phone') is-invalid @enderror" id="exampleFormControlInput2"
                placeholder="Insert phone number..." required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Position
            </label>
            <span class="text-xs @error('email') text-danger @enderror">*required</span>
            <input name="function" type="text" value="{{ $user->function }}"
                class="form-control  @error('function') is-invalid @enderror" id="exampleFormControlInput2"
                placeholder="Insert position..." required>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput2">Description
            </label>
            <span class="text-xs @error('email') text-danger @enderror">*optional</span>
            <input name="description" type="text" value="{{ $user->description }}"
                class="form-control  @error('description') is-invalid @enderror" id="exampleFormControlInput2"
                placeholder="Insert user description...">
        </div>
        <div class="form-group">
            <label for="">Active status</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{ $user->active ? 'checked' : '' }}
                    name="active" value="1">
                <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
            </div>
        </div>
        <button type="submit" class="btn btn-outline-dark">Save</button>
    </form>
@endsection
