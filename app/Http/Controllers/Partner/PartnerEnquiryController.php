<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\GymEnquiry;
use App\Models\Partners\Gym;

class PartnerEnquiryController extends Controller
{
    /**
     * Show the user enquiries for the partner's gyms.
     */
    public function index()
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        // Get all gym IDs belonging to this partner
        $gymIds = Gym::where('partner_id', $partnerId)->pluck('id');

        // Get enquiries belonging to these gyms
        $enquiries = GymEnquiry::with('gym')
                               ->whereIn('gym_id', $gymIds)
                               ->latest()
                               ->get();

        return view('partner.enquiries.index', compact('enquiries'));
    }
}
