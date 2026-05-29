<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Gym;
use App\Models\Partners\Partner;

use App\Models\GymhaiBlog;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Separate Dashboard for Staff
        if ($user && strtolower(trim($user->role)) === 'staff') {
            // Note: Currently counting total platform blogs. If user_id is mapped in gymhai_blogs in the future, change to GymhaiBlog::where('user_id', $user->id)->count()
            $totalBlogs = GymhaiBlog::count();
            return view('admin.staff-dashboard', compact('totalBlogs', 'user'));
        }

        // We will show system-wide stats on the main admin dashboard
        $totalGyms = Gym::count();
        $totalPartners = Partner::count();
        
        return view('admin.dashboard', compact('totalGyms', 'totalPartners'));
    }
}
