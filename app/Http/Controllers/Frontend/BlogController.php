<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Property;
use App\Support\InertiaSerializers;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_published', true)->latest()->paginate(6);

        $blogs->getCollection()->transform(function (Blog $blog) {
            return [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'author' => $blog->author,
                'excerpt' => $blog->excerpt,
                'image' => $blog->image ? asset('storage/'.$blog->image) : null,
                'created_at' => $blog->created_at?->toIso8601String(),
            ];
        });

        return Inertia::render('Blogs/Index', [
            'blogs' => $blogs,
        ]);
    }

    public function show(string $slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->where('is_published', true)
            ->latest()
            ->take(4)
            ->get()
            ->map(fn (Blog $b) => [
                'id' => $b->id,
                'title' => $b->title,
                'slug' => $b->slug,
                'excerpt' => $b->excerpt,
                'image' => $b->image ? asset('storage/'.$b->image) : null,
            ])
            ->values()
            ->all();

        $latestProperties = Property::where('status', 'approved')
            ->latest()
            ->take(5)
            ->get()
            ->map(fn (Property $p) => InertiaSerializers::propertyCard($p->loadMissing('agent')))
            ->values()
            ->all();

        return Inertia::render('Blogs/Show', [
            'blog' => [
                'id' => $blog->id,
                'title' => $blog->title,
                'slug' => $blog->slug,
                'author' => $blog->author,
                'content' => $blog->content,
                'image' => $blog->image ? asset('storage/'.$blog->image) : null,
                'created_at' => $blog->created_at?->toIso8601String(),
            ],
            'relatedBlogs' => $relatedBlogs,
            'latestProperties' => $latestProperties,
        ]);
    }
}
