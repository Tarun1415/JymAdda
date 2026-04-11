<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Partners\Partner;
use Carbon\Carbon;

class CheckPartnerPlan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $partnerId = session('partner_id');
        
        if (!$partnerId) {
            return redirect('/partner/login')->with('error', 'Please login first');
        }

        $partner = Partner::where('partner_id', $partnerId)->first();

        if (!$partner) {
            return redirect('/partner/login')->with('error', 'Partner not found');
        }

        if (empty($partner->plan_expires_at) || Carbon::parse($partner->plan_expires_at)->isPast()) {
            return redirect('/partner/pricing')->with('error', 'Your plan has expired. Please purchase a plan to continue.');
        }

        return $next($request);
    }
}
