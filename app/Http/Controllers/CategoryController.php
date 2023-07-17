<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect('/dashboard/categories');
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
            'name' => ['required', 'string']
        ]);

        $category = new Category();
        $category->name = $validatedData['name'];

        $category->save();

        return redirect('/dashboard/categories')->with('message', 'New category has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        return view('dashboard.admin.edit_category', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string']
        ]);

        $category->name = $validatedData['name'];

        $category->save();

        return redirect('/dashboard/categories')->with('message', "'" . $validatedData['name'] . "' has been updated!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->posts()->whereIn('status', ['published', 'archived'])->count() > 0) {
            return redirect()->back()->withErrors([
                'have-post' => 'The category to be deleted must have no posts.'
            ]);
        }
        
        $category->delete();

        foreach ($category->posts()->get() as $value) {
            $value->update([
                'status' => 'revision',
                'revision_note' => 'Update Category . ' . $value->revision_note
            ]);
        }

        return redirect()->back()->with('message',  'Category "' . $category->name . '" was successfully deleted.');
    }
}
