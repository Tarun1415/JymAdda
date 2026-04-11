<?php

namespace App\Http\Controllers\Partner\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Partner;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'name'     => 'required',
                'email'    => 'required|email|unique:partners,email',
                'mobile'   => 'required|digits:10|unique:partners,mobile',
                'state'    => 'required',
                'city'     => 'required',
                'password' => 'required',
            ]);

            $partner = Partner::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'mobile'   => $request->mobile,
                'state'    => $request->state,
                'city'     => $request->city,
                'password' => Hash::make($request->password),
                'token'    => (string) Str::uuid(),

                // ✅ 30 days Basic Plan by default
                'plan_name'       => 'basic',
                'plan_expires_at' => now()->addDays(30),
            ]);

            return redirect('/partner/login')
                ->with('success', 'Signup successful. Please login.');
        }

        return view('partner.auth.register');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $partner = Partner::where('email', $request->email)->first();

            if (!$partner || !Hash::check($request->password, $partner->password)) {
                return back()->with('error', 'Invalid login details');
            }

            $token = Str::random(60);
            $partner->update(['token' => $token]);

            session([
                'partner_id'    => $partner->partner_id,
                'partner_token' => $token,
            ]);

            // ✅ Plan expiry check redirection
            if (empty($partner->plan_expires_at) || Carbon::parse($partner->plan_expires_at)->isPast()) {
                return redirect('/partner/pricing')->with('error', 'Your plan has expired. Please choose a plan to continue.');
            }

            return redirect('/partner/dashboard');
        }

        return view('partner.auth.login');
    }
}
