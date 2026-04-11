<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Partner;
use App\Models\SubscriptionPlan;
use App\Models\PartnerTransaction;
use Carbon\Carbon;

class PartnerSubscriptionController extends Controller
{
    public function pricing()
    {
        $partnerId = session('partner_id');
        $partner = Partner::where('partner_id', $partnerId)->firstOrFail();
        
        $razorpayKey = env('RAZORPAY_KEY', 'rzp_test_Sc8JTYEHTz00tm');
        $plans = SubscriptionPlan::where('status', 'active')->get();

        return view('partner.pricing', compact('partner', 'razorpayKey', 'plans'));
    }

    public function verifyPayment(Request $request)
    {
        $partnerId = session('partner_id');
        $partner = Partner::where('partner_id', $partnerId)->firstOrFail();

        $planId = $request->plan_id;
        $plan = SubscriptionPlan::findOrFail($planId);
        
        // Use confirm_price if available, else standard price for logging
        $amountPaid = $plan->confirm_price ? $plan->confirm_price : $plan->price;
        
        $durationMonths = $plan->duration_months;
        $planName = $plan->plan_name;
        
        // Log transaction
        PartnerTransaction::create([
            'partner_id' => $partnerId,
            'subscription_plan_id' => $plan->id,
            'amount_paid' => $amountPaid,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'status' => 'success'
        ]);
        
        $baseDate = ($partner->plan_expires_at && Carbon::parse($partner->plan_expires_at)->isFuture()) 
            ? Carbon::parse($partner->plan_expires_at) 
            : Carbon::now();
            
        $newExpiry = $baseDate->addMonths($durationMonths);
        
        $gymLimit = 1;
        if (strtolower($planName) === 'standard') {
            $gymLimit = 3;
        } elseif (strtolower($planName) === 'premium') {
            $gymLimit = 5;
        }
        
        $partner->update([
            'plan_name' => $planName,
            'plan_expires_at' => $newExpiry,
            'gym_limit' => $gymLimit
        ]);

        return redirect('/partner/dashboard')->with('success', 'Plan activated successfully! Welcome back.');
    }
}
