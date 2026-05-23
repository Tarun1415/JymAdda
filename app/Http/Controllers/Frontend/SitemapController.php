<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partners\Gym;
use App\Models\GymhaiBlog;
use App\Models\BankDetail;

class SitemapController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Main Sitemap Index
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $bankCount = BankDetail::whereNotNull('ifsc')->count();

        // 10k URLs per sitemap
        $perPage = 10000;

        $totalBankSitemaps = ceil($bankCount / $perPage);

        return response()
            ->view('frontend.sitemap-index', compact(
                'totalBankSitemaps'
            ))
            ->header('Content-Type', 'text/xml');
    }

    /*
    |--------------------------------------------------------------------------
    | Main Website Sitemap
    |--------------------------------------------------------------------------
    */

    public function mainSitemap()
    {
        $activeGyms = Gym::where('status', 'active')
            ->select('slug', 'updated_at')
            ->get();

        $blogs = GymhaiBlog::where('status', 'published')
            ->select('slug', 'updated_at')
            ->get();

        return response()
            ->view('frontend.sitemap-main', compact(
                'activeGyms',
                'blogs'
            ))
            ->header('Content-Type', 'text/xml');
    }

    /*
    |--------------------------------------------------------------------------
    | Bank Sitemap
    |--------------------------------------------------------------------------
    */

    public function bankSitemap($page)
    {
        // 10k URLs per sitemap
        $perPage = 10000;

        $banks = BankDetail::query()
            ->whereNotNull('ifsc')
            ->whereNotNull('bank_slug')
            ->whereNotNull('state_slug')
            ->select(
                'bank_slug',
                'state_slug',
                'district_slug',
                'ifsc_slug',
                'ifsc',
                'updated_at'
            )
            ->skip(($page - 1) * $perPage)
            ->take($perPage)
            ->get();

        if ($banks->isEmpty()) {
            abort(404);
        }

        return response()
            ->view('frontend.bank-sitemap', compact('banks'))
            ->header('Content-Type', 'text/xml');
    }
}