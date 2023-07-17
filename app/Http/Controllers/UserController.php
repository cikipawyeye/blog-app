<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        return view('dashboard.admin.users', ['users' =>  User::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        return view('dashboard.admin.create_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8', 'alpha_num', 'regex:/[0-9]/'],
            'role' => ['required', new Enum(UserRole::class)],
            'phone' => ['required', 'numeric'],
            'function' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'active' => ['required', 'boolean']
        ]);

        $user = new User();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role'];
        $user->phone = $validatedData['phone'];
        $user->function = $validatedData['function'];
        $user->description = $validatedData['description'];
        $user->active = $validatedData['active'] ?? 0;

        $user->save();

        return redirect('/users')->with('message', 'Create account success');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.admin.edit_user', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'min:8', 'alpha_num', 'regex:/[0-9]/'],
            'role' => ['required', new Enum(UserRole::class)],
            'phone' => ['required', 'numeric'],
            'function' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'active' => ['required', 'boolean']
        ]);

        // check password
        if ($validatedData['password']) {
            $user->password = Hash::make($validatedData['password']);
        }
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];
        $user->phone = $validatedData['phone'];
        $user->function = $validatedData['function'];
        $user->description = $validatedData['description'];
        $user->active = $validatedData['active'] ?? 0;

        $user->save();

        return redirect('/users')->with('message', 'Update ' . $user->name . '`s account success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
