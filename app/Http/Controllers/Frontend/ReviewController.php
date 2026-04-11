<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\GymReview;
use App\Models\Partners\Gym;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gym_id' => 'required|exists:gyms,id',
            'user_name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        GymReview::create($validated);

        // Aggregate ratings
        $gym = Gym::findOrFail($validated['gym_id']);
        $reviews = GymReview::where('gym_id', $gym->id)->get();
        
        $total_reviews = $reviews->count();
        $average_rating = $reviews->avg('rating');

        $gym->update([
            'rating' => number_format($average_rating, 1),
            'total_reviews' => $total_reviews
        ]);

        return redirect()->back()->with('success', 'Your review has been submitted successfully!');
    }
}
