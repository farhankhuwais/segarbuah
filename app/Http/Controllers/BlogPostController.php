<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('author')
            ->published()
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('pages.blog.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = BlogPost::with('author')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        $recent = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'recent'));
    }
}
