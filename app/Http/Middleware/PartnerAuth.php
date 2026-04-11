<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PartnerAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('partner_id')) {
            return redirect('/partner/login')->with('error', 'Please login first');
        }

        return $next($request);
    }
}
