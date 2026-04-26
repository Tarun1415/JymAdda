<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Partners\Gym;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        SEOMeta::setTitle('GymHai | India\'s #1 Gym Discovery & Fitness Platform');
        SEOMeta::setDescription('Discover the best gyms, top fitness centers, and specialized workout facilities near you. Join the GymHai community and accelerate your physical transformation today.');
        SEOMeta::setCanonical(url()->current());
        SEOMeta::setKeywords('gym near me, best fitness center, workout plans, local gym discover, gym memberships, personal trainer, India fitness, bodybuilding');

        OpenGraph::setTitle('GymHai | Discover the Best Gyms Near You');
        OpenGraph::setDescription('Find and join the best gyms and fitness centers in your city.');
        OpenGraph::setUrl(url()->current());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::setSiteName('GymHai');
        OpenGraph::addImage(asset('images/jym1.jpg'));

        TwitterCard::setTitle('GymHai | Find Your Perfect Workout Space');
        TwitterCard::setSite('@GymHaiIndia');
        TwitterCard::addValue('card', 'summary_large_image');
        $city = session('user_city');

        if (! $city) {
            try {
                $ip = $request->ip();

                // For robust fast lookups without holding up page load
                $ctx = stream_context_create(['http' => ['timeout' => 1]]);
                $response = @file_get_contents("http://ip-api.com/json/{$ip}?fields=city", false, $ctx);

                if ($response) {
                    $data = json_decode($response);
                    if (! empty($data->city)) {
                        $city = $data->city;
                        session(['user_city' => $city]);
                    }
                }
            } catch (\Exception $e) {
                // Silently ignore if API is unreachable so user experience remains uninterrupted
            }
        }

        $topRatedGyms = collect();

        // 1. Fetch Top Rated Gyms in the detected city
        if ($city) {
            $topRatedGyms = Gym::where('status', 'active')
                ->where('city', 'like', "%{$city}%")
                ->orderByDesc('rating')
                ->orderByDesc('total_reviews')
                ->take(10)
                ->get();
        }

        // 2. Graceful Fallback: If less than 4 gyms in the user's city, fill rest with global highest-rated
        if ($topRatedGyms->count() < 10) {
            $fallbackLimit = 10 - $topRatedGyms->count();
            $fallbackGyms = Gym::where('status', 'active')
                ->when($topRatedGyms->isNotEmpty(), function ($q) use ($topRatedGyms) {
                    $q->whereNotIn('id', $topRatedGyms->pluck('id'));
                })
                ->orderByDesc('rating')
                ->orderByDesc('total_reviews')
                ->take($fallbackLimit)
                ->get();

            $topRatedGyms = $topRatedGyms->merge($fallbackGyms);
        }

        return view('frontend.index', compact('topRatedGyms', 'city'));
    }

    public function gyms(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $city = trim((string) $request->get('city', ''));
        $pincode = trim((string) $request->get('pincode', ''));

        $titleParams = array_filter([$q, $city, $pincode]);
        $searchString = !empty($titleParams) ? ' - ' . implode(', ', $titleParams) : '';

        // Dynamic SEO based on Search
        SEOMeta::setTitle('Explore Gyms & Fitness Centers' . $searchString . ' | GymHai');
        SEOMeta::setDescription('Find the best gyms and top-rated fitness centers' . ($city ? ' in '.$city : ' near you') . '. Read comprehensive reviews, check pricing, and join today on GymHai.');
        SEOMeta::setCanonical(url()->full());

        OpenGraph::setTitle('Find Premium Gyms' . $searchString . ' | GymHai');
        OpenGraph::setUrl(url()->full());
        OpenGraph::addProperty('type', 'website');
        OpenGraph::setSiteName('GymHai');

        $sort = trim((string) $request->get('sort', 'newest'));

        $gymsQuery = Gym::query()
            ->where('status', 'active')
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($qq) use ($q) {
                    $qq->where('gym_name', 'like', "%{$q}%")
                        ->orWhere('slug', 'like', "%{$q}%")
                        ->orWhere('city', 'like', "%{$q}%")
                        ->orWhere('pincode', 'like', "%{$q}%");
                });
            })
            ->when($city !== '', fn ($query) => $query->where('city', 'like', "%{$city}%"))
            ->when($pincode !== '', fn ($query) => $query->where('pincode', 'like', "%{$pincode}%"));

        if ($sort === 'top_rated') {
            $gymsQuery->orderByDesc('rating')->orderByDesc('total_reviews');
        } else {
            $gymsQuery->latest();
        }

        $gyms = $gymsQuery->paginate(12)
            ->appends($request->query());

        return view('frontend.pages.gyms-index', compact('gyms', 'q', 'city', 'pincode'));
    }

    // ✅ UPDATED Suggestion logic (city/pincode -> show gyms list + View All)
    public function suggest(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        if ($q === '') {
            return response()->json(['gyms' => [], 'view_all' => null]);
        }

        $gyms = Gym::query()
            ->where('status', 'active')
            ->where(function ($query) use ($q) {
                $query->whereRaw('LOWER(gym_name) LIKE ?', ['%'.mb_strtolower($q).'%'])
                    ->orWhereRaw('LOWER(city) LIKE ?', ['%'.mb_strtolower($q).'%'])
                    ->orWhere('pincode', 'like', "%{$q}%")
                    ->orWhereRaw('LOWER(slug) LIKE ?', ['%'.mb_strtolower($q).'%']);
            })
            ->select('gym_name', 'slug', 'city', 'state', 'gym_image', 'description')
            ->limit(5)
            ->get()
            ->map(function ($g) {
                return [
                    'name' => $g->gym_name,
                    'city' => $g->city,
                    'state' => $g->state,
                    'image' => $g->gym_image ? asset($g->gym_image) : asset('images/img_1.jpg'),
                    'desc' => Str::limit(trim(strip_tags((string) $g->description)), 60),
                    'url' => url('/'.$g->slug),
                ];
            });

        return response()->json([
            'gyms' => $gyms,
            'view_all' => route('gyms.index', ['q' => $q]),
        ]);
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($request->all());

        return back()->with('success', 'Your message has been sent successfully. Our team will get back to you soon!');
    }

    public function setUserCity(Request $request)
    {
        if ($request->city) {
            session(['user_city' => trim($request->city)]);
            return response()->json(['success' => true, 'city' => $request->city]);
        }
        return response()->json(['success' => false], 400);
    }
}
