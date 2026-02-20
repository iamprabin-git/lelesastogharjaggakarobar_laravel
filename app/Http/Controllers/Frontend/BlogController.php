<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Property;

class BlogController extends Controller
{
    public function index()
{
    $blogs = Blog::where('is_published', true)->latest()->paginate(6);
    return view('frontend.blogs.index', compact('blogs')); // correct view
}

public function show($slug)
{
    $blog = Blog::where('slug', $slug)->firstOrFail();

    // Related blogs (excluding current blog)
    $relatedBlogs = Blog::where('id', '!=', $blog->id)
        ->where('is_published', true)
        ->latest()
        ->take(4)
        ->get();

    // Latest properties (optional – if you have Property model)
    $latestProperties = Property::latest()
        ->take(5)
        ->get();

    return view('frontend.blogs.show', compact(
        'blog',
        'relatedBlogs',
        'latestProperties'
    ));
}

}
