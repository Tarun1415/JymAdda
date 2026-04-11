<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Partner;


use App\Models\Partners\Gym;
use App\Models\Partners\GymMember;
use App\Models\Partners\GymGallery;
use App\Models\Frontend\GymEnquiry;


class PartnerDashboardController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        $partnerId = session('partner_id');
        $partner = Partner::find($partnerId);

        // Sub-queries
        $gymIds = Gym::where('partner_id', $partnerId)->pluck('id');

        // Main Widget Counts
        $totalGyms = $gymIds->count();
        $totalMembers = GymMember::where('partner_id', $partnerId)->count();
        $totalEnquiries = GymEnquiry::whereIn('gym_id', $gymIds)->count();
        $totalPhotos = GymGallery::whereIn('gym_id', $gymIds)->count();

        // Financial Widget Sums
        $totalFeesPaid = GymMember::where('partner_id', $partnerId)->sum('amount_paid');
        $totalFeesDue = GymMember::where('partner_id', $partnerId)->sum('pending_amount');

        // Recent Activity Lists
        $recentMembers = GymMember::with('gym')
                                  ->where('partner_id', $partnerId)
                                  ->latest()
                                  ->take(5)
                                  ->get();

        $recentEnquiries = GymEnquiry::with('gym')
                                     ->whereIn('gym_id', $gymIds)
                                     ->latest()
                                     ->take(5)
                                     ->get();

        return view('partner.dashboard', compact(
            'partner', 
            'totalGyms', 
            'totalMembers', 
            'totalEnquiries', 
            'totalPhotos',
            'totalFeesPaid',
            'totalFeesDue',
            'recentMembers',
            'recentEnquiries'
        ));
    }

    // Logout
    public function logout()
{
    session()->forget(['partner_id', 'partner_token']);
    return redirect('/partner/login')->with('success', 'Logged out successfully');
}

}
