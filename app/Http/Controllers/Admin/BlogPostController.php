<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('author')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'image' => 'nullable|max:500',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = auth()->id();
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;

        BlogPost::create($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $blogPost)
    {
        return view('admin.blog.form', compact('blogPost'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'excerpt' => 'nullable|max:500',
            'image' => 'nullable|max:500',
            'is_published' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? ($blogPost->published_at ?? now()) : null;

        $blogPost->update($data);

        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted.');
    }
}
