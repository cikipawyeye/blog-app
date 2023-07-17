<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.dashboard');
    }


    // show all posts
    public function showAll()
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        $data = Post::where('status', 'published')
            ->orWhere('status', 'archived')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('dashboard.admin.all_posts', [
            'posts' => $data, 
            'tab' => 'all', 
            'count' => $this->countPost(),
            'breadcrumb' => [
                'Posts' => '/dashboard/posts', 
                'All Post' => '/posts'
            ]
        ]);
    }

    // show active posts
    public function showActive($logged_user_only = false)
    {
        if ($logged_user_only) {
            $data = Auth::user()->posts->where('status', 'published')
                ->sortByDesc('updated_at');

            return view('dashboard.user.my-posts', [
                'posts' => $data,
                'tab' => 'active',
                'count' => $this->countPost($logged_user_only)
            ]);
        }

        if (Auth::user()->role == "user") {
            return redirect('/dashboard/my-active-posts');
        }

        $data = Post::where('status', 'published')
            ->orderBy('updated_at', 'desc')
            ->get();
        return view('dashboard.admin.all_posts', [
            'posts' => $data,
            'tab' => 'active',
            'count' => $this->countPost($logged_user_only)
        ]);
    }

    // show archived posts
    public function showArchived($logged_user_only = false)
    {
        if ($logged_user_only) {
            $data = Auth::user()->posts->where('status', 'archived')
                ->sortByDesc('updated_at');

            return view('dashboard.user.my-posts', [
                'posts' => $data,
                'tab' => 'inactive',
                'count' => $this->countPost($logged_user_only)
            ]);
        }

        if (Auth::user()->role == "user") {
            return redirect('/dashboard/my-inactive-posts');
        }

        $data = Post::where('status', 'archived')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('dashboard.admin.all_posts', [
            'posts' => $data,
            'tab' => 'inactive',
            'count' => $this->countPost()
        ]);
    }

    // search posts
    public function search(Request $req, $logged_user_only = false)
    {
        $keyword = $req->keyword;
        if ($logged_user_only) {
            if ($keyword == "" || is_null($keyword)) return redirect('/dashboard/myposts');

            $userPosts = Auth::user()->posts
                ->whereIn('status', ['published', 'archived']);

            $filteredData = $userPosts->filter(function ($value, $key) use ($keyword) {
                return str_contains(strtolower($value->title), strtolower($keyword));
            });

            return view('dashboard.user.my-posts', [
                'posts' => $filteredData,
                'tab' => '',
                'count' => $this->countPost(true)
            ]);
        }

        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        if ($keyword == "" || is_null($keyword)) return redirect('/dashboard/all-posts');

        $data = Post::where('title', 'like', '%' . $keyword . '%')
            ->whereIn('status', ['published', 'archived'])
            ->get();

        return view('dashboard.admin.all_posts', [
            'posts' => $data,
            'tab' => '',
            'count' => $this->countPost()
        ]);
    }

    // show post
    public function post(Post $post)
    {
        if (Auth::user()->role == "user") {
            if (Gate::denies('see-post', $post)) {
                return redirect('/dashboard/myposts');
            }
        }

        return view('dashboard.post', [
            'post' => $post
        ]);
    }

    // show all draft posts
    public function draft()
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/mydrafts');
        }

        $data = Post::whereIn('status', ['draft', 'revision'])
            ->latest()
            ->get();

        return view('dashboard.admin.drafts', ['posts' => $data]);
    }

    // search draft posts
    public function searchAllDrafts(Request $req)
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/mydrafts');
        }

        if ($req->keyword == "" || is_null($req->keyword)) return redirect('/dashboard/drafts');

        $data = Post::where('title', 'like', '%' . $req->keyword . '%')
            ->where('status', 'draft')
            ->orWhere('status', 'revision')
            ->get();

        return view('dashboard.admin.drafts', ['posts' => $data]);
    }

    // show categories
    public function categories()
    {
        if (Auth::user()->role == "user") {
            return redirect('/dashboard/myposts');
        }

        return view('dashboard.admin.categories', ['categories' =>  Category::all()]);
    }

    // count the approved posts
    private function countPost($logged_user_only = false)
    {
        if ($logged_user_only) {
            return [
                "allPost" => Auth::user()->posts->whereIn('status', ['published', 'archived'])->count(),
                "activePost" => Auth::user()->posts->where("status", "published")->count(),
                "archivedPost" => Auth::user()->posts->where("status", "archived")->count()
            ];
        }

        return [
            "allPost" => Post::whereIn('status', ['published', 'archived'])->count(),
            "activePost" => Post::where("status", "published")->count(),
            "archivedPost" => Post::where("status", "archived")->count()
        ];
    }

    // show logged user posts
    public function myPosts()
    {
        return view('dashboard.user.my-posts', [
            'posts' => Auth::user()->posts
                ->whereIn('status', ['published', 'archived'])
                ->sortByDesc('updated_at'),
            'tab' => 'all',
            'count' => $this->countPost(true)
        ]);
    }

    // show logged user need revision post
    public function needRevisions()
    {
        return view('dashboard.user.need-revision', [
            'posts' => Auth::user()->posts->where('status', 'revision')
        ]);
    }

    // show logged user drafts
    public function myDrafts()
    {
        return view('dashboard.user.drafts', [
            'posts' => Auth::user()->posts->where('status', 'draft')->sortByDesc('updated_at')
        ]);
    }
}
