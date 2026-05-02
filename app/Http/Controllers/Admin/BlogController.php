<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GymhaiBlog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = GymhaiBlog::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['featured_image', 'meta_keywords']);
        $data['slug'] = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $data['meta_keywords'] = isset($request->meta_keywords) && is_array($request->meta_keywords) ? json_encode(array_filter($request->meta_keywords)) : (isset($request->meta_keywords) ? $request->meta_keywords : null);

        
        // Ensure slug is unique
        $originalSlug = $data['slug'];
        $count = 1;
        while(GymhaiBlog::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count;
            $count++;
        }

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['featured_image'] = 'uploads/blogs/' . $filename;
        }

        if ($request->status === 'published' && !$request->published_at) {
            $data['published_at'] = now();
        }

        GymhaiBlog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    public function edit(GymhaiBlog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, GymhaiBlog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except(['featured_image', 'meta_keywords']);
        $data['meta_keywords'] = isset($request->meta_keywords) && is_array($request->meta_keywords) ? json_encode(array_filter($request->meta_keywords)) : (isset($request->meta_keywords) ? $request->meta_keywords : null);
        
        if ($request->slug && $request->slug !== $blog->slug) {
            $data['slug'] = Str::slug($request->slug);
            $originalSlug = $data['slug'];
            $count = 1;
            while(GymhaiBlog::where('slug', $data['slug'])->where('id', '!=', $blog->id)->exists()) {
                $data['slug'] = $originalSlug . '-' . $count;
                $count++;
            }
        }

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
                unlink(public_path($blog->featured_image));
            }
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/blogs'), $filename);
            $data['featured_image'] = 'uploads/blogs/' . $filename;
        }

        if ($request->status === 'published' && $blog->status !== 'published') {
            $data['published_at'] = now();
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy(GymhaiBlog $blog)
    {
        if ($blog->featured_image && file_exists(public_path($blog->featured_image))) {
            unlink(public_path($blog->featured_image));
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    public function updateStatus(Request $request, GymhaiBlog $blog)
    {
        $request->validate(['status' => 'required|in:draft,published']);
        $data = ['status' => $request->status];
        if ($request->status === 'published' && !$blog->published_at) {
            $data['published_at'] = now();
        }
        $blog->update($data);
        return redirect()->back()->with('success', 'Blog status updated successfully!');
    }
}
