<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GymhaiBlog;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class BlogController extends Controller
{
    public function index()
    {
        SEOMeta::setTitle('Blog - GymHai');
        SEOMeta::setDescription('Read the latest articles on fitness, health, and gym workouts from GymHai.');
        SEOMeta::setCanonical(url()->current());
        OpenGraph::setTitle('Blog - GymHai');
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::setSiteName('GymHai');

        $blogs = GymhaiBlog::where('status', 'published')
                           ->orderBy('published_at', 'desc')
                           ->paginate(12);
        return view('frontend.pages.blogs.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = GymhaiBlog::where('slug', $slug)->where('status', 'published')->firstOrFail();
        // Increment views
        $blog->increment('views');

        // SEO Setup
        SEOMeta::setTitle($blog->meta_title ?? ($blog->title . ' - Blog ' . ($blog->city ? 'in '.$blog->city : '')));
        SEOMeta::setDescription($blog->meta_description ?? strip_tags(Str::limit($blog->content, 160)));
        SEOMeta::setCanonical(url()->current());
        
        if ($blog->meta_keywords) {
            $keywords = is_array(json_decode($blog->meta_keywords, true)) 
                ? implode(', ', json_decode($blog->meta_keywords, true)) 
                : $blog->meta_keywords;
            SEOMeta::setKeywords($keywords);
        }

        OpenGraph::setTitle($blog->meta_title ?? ($blog->title . ' - Blog ' . ($blog->city ? 'in '.$blog->city : '')));
        OpenGraph::setDescription(SEOMeta::getDescription());
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'article');
        OpenGraph::setSiteName('GymHai');
        
        $image = $blog->featured_image;
        if ($image) {
            OpenGraph::addImage(asset($image));
            TwitterCard::setImage(asset($image));
        }
        
        TwitterCard::setTitle(SEOMeta::getTitle());
        TwitterCard::setSite('@GymHaiIndia');

        $recentBlogs = GymhaiBlog::where('status', 'published')
                                 ->where('id', '!=', $blog->id)
                                 ->orderBy('published_at', 'desc')
                                 ->take(3)
                                 ->get();

        return view('frontend.pages.blogs.show', compact('blog', 'recentBlogs'));
    }
}
