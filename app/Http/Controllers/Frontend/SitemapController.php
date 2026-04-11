<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partners\Gym;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        // Get all active gyms to generate dynamic URLs
        $activeGyms = Gym::where('status', 'active')
            ->select('slug', 'updated_at')
            ->get();

        return response()->view('frontend.sitemap', compact('activeGyms'))
                         ->header('Content-Type', 'text/xml');
    }
}
