<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Gym;
use App\Models\Partners\Partner;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // We will show system-wide stats on the main admin dashboard
        $totalGyms = Gym::count();
        $totalPartners = Partner::count();
        
        return view('admin.dashboard', compact('totalGyms', 'totalPartners'));
    }
}
