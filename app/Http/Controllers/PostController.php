<?php

namespace App\Http\Controllers;

use App\Enums\PostStatus;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Enum;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('public.blog.posts', [
            'posts' => Post::where('status', 'published')
                ->latest()
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();

        $validatedData = $request->validate([
            'img' => 'nullable|image|file|max:2048',
            'title' => 'required',
            'category' => 'required|numeric|max:10',
            'description' => 'nullable',
            'content' => 'required'
        ]);

        if ($request->file('img')) {
            $validatedData['img'] = $request->file('img')->store('post-banner');
            $post->banner_url = $validatedData['img'];
        }

        $creator_id = Auth::user()->id;

        $post->title = $validatedData['title'];
        $post->category_id = $validatedData['category'];
        $post->acc_by = null;
        $post->description = $validatedData['description'];
        $post->post = $validatedData['content'];

        $post->created_by = $creator_id;
        $post->status = 'draft';
        $post->revision_note = '-';

        $post->save();

        DB::table('writers')->insert([
            'post_id' => $post->id,
            'user_id' => $creator_id,
        ]);

        return redirect('/dashboard/mydrafts')->with('status', '<strong>Success!</strong> New post saved in drafts, awaiting approval.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if ($post->status == 'published') {
            return view('public.blog.post', ['post' => $post]);
        }
        return view('public.not-found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if ($post->status === 'published' || $post->status === 'archived') {
            if (Auth::user()->role == 'user') {
                return abort(403);
            }
        } else {
            if (Gate::denies('see-post', $post)) {
                return redirect('/dashboard/myposts');
            }
        }

        return view('dashboard.edit', [
            'categories' => Category::all(),
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $editor = Auth::user();

        // check post status
        if ($editor->role === 'admin') {
            if ($post->status !== 'published' &&  $post->status !== 'archived' && Gate::denies('see-post', $post)) {
                return redirect('/dashboard/myposts');
            }
        } else {
            if ($post->status !== 'published' && $post->status !== 'archived' && Gate::allows('see-post', $post)) {
                $post->status = 'draft';
            } else {
                return abort(403);
            }
        }

        // validation
        $validatedData = $request->validate([
            'img' => 'nullable|image|file|max:2048',
            'title' => 'required',
            'category' => 'required|numeric|max:10',
            'description' => 'nullable',
            'content' => 'required'
        ]);

        if ($request->file('img')) {
            $validatedData['img'] = $request->file('img')->store('post-banner');
            $post->banner_url = $validatedData['img'];
        } else {
            if ($request['rm-banner']) {
                $post->banner_url = null;
            }
        }

        $post->title = $validatedData['title'];
        $post->category_id = $validatedData['category'];
        $post->description = $validatedData['description'];
        $post->post = $validatedData['content'];

        if ($editor->role === 'admin') {
            $validatedAdminData = $request->validate([
                'status' => ['required', new Enum(PostStatus::class)]
            ]);
            $post->status = $validatedAdminData['status'];
        }

        $post->save();

        // check pivot table
        $userExist = DB::table('writers')
            ->where('post_id', '=', $post->id)
            ->where('user_id', '=', $editor->id)
            ->doesntExist();

        // add editor to post
        if ($userExist) {
            DB::table('writers')->insert([
                'post_id' => $post->id,
                'user_id' => $editor->id,
            ]);
        }


        if ($editor->role == 'admin') {
            if ($post->status == 'draft' || $post->status == 'revision') {
                return redirect('/dashboard/drafts')->with('message', 'Success! Post has been updated.');
            }

            return redirect('/dashboard/all-posts')->with('message', 'Success! Post has been updated.');
        } else {
            return redirect('/dashboard/mydrafts')->with('message', 'Success! Post has been updated.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // publish post
    public function publish(Post $post)
    {
        if (Auth::user()->role == 'user') {
            return abort(403);
        }

        // validate category
        if ($post->category) {
            $post->acc_by = Auth::user()->id;
            $post->status = 'published';

            $post->save();

            return redirect('/dashboard/all-posts')->with('message', 'Post Published');
        }

        return redirect('/dashboard/drafts')->withErrors(['category' => 'Post category not valid!']);
    }

    // post revision 
    public function revision(Request $request, Post $post)
    {
        if (Auth::user()->role == 'user') {
            return abort(403);
        }

        $validatedData = $request->validate([
            "revision-note" => ['nullable', 'string']
        ]);

        $post->status = 'revision';
        $post->revision_note = $validatedData['revision-note'];

        $post->save();

        return redirect('/dashboard/drafts')->with('status', 'Waiting for the post to be revised');
    }

    // enable post
    public function enable(Post $post)
    {
        if (Auth::user()->role == 'user') {
            return abort(403);
        }

        if ($post->status !== 'archived') {
            return abort(403);
        }

        $post->status = 'published';

        $post->save();

        return redirect('/dashboard/all-posts')->with('message', 'Post Enabled');
    }

    // disable post
    public function disable(Post $post)
    {
        if (Auth::user()->role == 'user') {
            return abort(403);
        }

        $post->status = 'archived';

        $post->save();

        return redirect('/dashboard/all-posts')->with('message', 'Post Disabled');
    }
}
