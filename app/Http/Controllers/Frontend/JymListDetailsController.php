<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Partners\Gym;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class JymListDetailsController extends Controller
{
   public function getJymDetails($slug)
{
    $slug = trim($slug);

    $jymListDetails = Gym::with(['galleries', 'reviews' => function($query) {
        $query->latest()->limit(10);
    }])
        ->whereRaw('TRIM(slug) = ?', [$slug])
        ->where('status', 'active')
        ->first();

    if (!$jymListDetails) {
        abort(404);
    }

    SEOMeta::setTitle($jymListDetails->seo_title ?? ($jymListDetails->gym_name . ' - Gym ' . ($jymListDetails->city ? 'in '.$jymListDetails->city : '')));
    SEOMeta::setDescription($jymListDetails->seo_description ?? strip_tags(Str::limit($jymListDetails->description, 160)));
    SEOMeta::setCanonical(url()->current());
    
    if ($jymListDetails->seo_keywords) {
        $keywords = is_array(json_decode($jymListDetails->seo_keywords, true)) 
            ? implode(', ', json_decode($jymListDetails->seo_keywords, true)) 
            : $jymListDetails->seo_keywords;
        SEOMeta::setKeywords($keywords);
    }

    OpenGraph::setTitle($jymListDetails->seo_title ?? $jymListDetails->gym_name);
    OpenGraph::setDescription(SEOMeta::getDescription());
    OpenGraph::setUrl(url()->current());
    OpenGraph::addProperty('type', 'place');
    OpenGraph::setSiteName('GymHai');
    
    $image = $jymListDetails->seo_image ?? $jymListDetails->gym_image;
    if ($image) {
        OpenGraph::addImage(asset($image));
        TwitterCard::setImage(asset($image));
    }
    
    TwitterCard::setTitle(SEOMeta::getTitle());
    TwitterCard::setSite('@GymHaiIndia');

    return view('frontend.pages.jym-details', compact('jymListDetails'));
}

}
