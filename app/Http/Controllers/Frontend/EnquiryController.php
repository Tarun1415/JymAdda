<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\GymEnquiry;
use App\Models\Partners\Gym;

class EnquiryController extends Controller
{
    /**
     * Store a quick enquiry.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gym_id' => 'required|exists:gyms,id',
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'message' => 'nullable|string|max:1000',
        ]);

        GymEnquiry::create([
            'gym_id' => $request->gym_id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your enquiry has been sent successfully. The gym owner will contact you soon.');
    }
}
