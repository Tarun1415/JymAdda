<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Gym;
use App\Models\Partners\GymMember;
use Carbon\Carbon;

class PartnerGymMemberController extends Controller
{
    /**
     * Display a listing of the members.
     */
    public function index(Request $request)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $gyms = Gym::where('partner_id', $partnerId)->get();
        $gymIds = $gyms->pluck('id');

        $query = GymMember::with('gym')->whereIn('gym_id', $gymIds);

        // Optional filtering by gym
        if ($request->has('gym_id') && $request->gym_id != '') {
            $query->where('gym_id', $request->gym_id);
        }

        // Optional text search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('mobile', 'LIKE', "%{$search}%")
                  ->orWhere('member_id', 'LIKE', "%{$search}%");
            });
        }

        $members = $query->latest()->paginate(10)->withQueryString();

        return view('partner.members.index', compact('members', 'gyms'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $gyms = Gym::where('partner_id', $partnerId)->get();
        return view('partner.members.create', compact('gyms'));
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $request->validate([
            'gym_id' => 'required|exists:gyms,id',
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'adhar_no' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'plan_duration' => 'required|string',
            'start_date' => 'required|date',
            'total_fees' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'status' => 'required|in:active,expired,pending',
        ]);

        // Calculate end date based on plan duration (basic assumption)
        $endDate = null;
        if ($request->start_date) {
            $start = Carbon::parse($request->start_date);
            if (str_contains(strtolower($request->plan_duration), '1 month')) {
                $endDate = $start->copy()->addMonth();
            } elseif (str_contains(strtolower($request->plan_duration), '3 month')) {
                $endDate = $start->copy()->addMonths(3);
            } elseif (str_contains(strtolower($request->plan_duration), '6 month')) {
                $endDate = $start->copy()->addMonths(6);
            } elseif (str_contains(strtolower($request->plan_duration), '1 year')) {
                $endDate = $start->copy()->addYear();
            } else {
                $endDate = $start->copy()->addMonth(); // default fallback
            }
        }

        GymMember::create([
            'gym_id' => $request->gym_id,
            'partner_id' => $partnerId,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'adhar_no' => $request->adhar_no,
            'address' => $request->address,
            'plan_duration' => $request->plan_duration,
            'start_date' => $request->start_date,
            'end_date' => $endDate,
            'total_fees' => $request->total_fees,
            'amount_paid' => $request->amount_paid,
            'status' => $request->status,
        ]);

        return redirect()->route('Partnerjym.members.index')->with('success', 'Gym Member registered successfully!');
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit($uuid)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $member = GymMember::where('uuid', $uuid)->where('partner_id', $partnerId)->firstOrFail();
        $gyms = Gym::where('partner_id', $partnerId)->get();

        return view('partner.members.edit', compact('member', 'gyms'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, $uuid)
    {
         $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $member = GymMember::where('uuid', $uuid)->where('partner_id', $partnerId)->firstOrFail();

        $request->validate([
            'gym_id' => 'required|exists:gyms,id',
            'name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
            'total_fees' => 'required|numeric|min:0',
            'amount_paid' => 'required|numeric|min:0',
            'new_payment' => 'nullable|numeric|min:0',
            'status' => 'required|in:active,expired,pending',
        ]);

        // If they updated start date or plan, recalculate
        $endDate = $member->end_date;
        if ($request->has('start_date') && $request->has('plan_duration')) {
            $start = Carbon::parse($request->start_date);
            if (str_contains(strtolower($request->plan_duration), '1 month')) {
                $endDate = $start->copy()->addMonth();
            } elseif (str_contains(strtolower($request->plan_duration), '3 month')) {
                $endDate = $start->copy()->addMonths(3);
            } elseif (str_contains(strtolower($request->plan_duration), '6 month')) {
                $endDate = $start->copy()->addMonths(6);
            } elseif (str_contains(strtolower($request->plan_duration), '1 year')) {
                $endDate = $start->copy()->addYear();
            }
        }

        if ($request->has('new_payment') && $request->new_payment > 0) {
            $finalAmountPaid = $request->amount_paid + $request->new_payment;
        } else {
            $finalAmountPaid = $request->amount_paid;
        }

        $member->update([
            'gym_id' => $request->gym_id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'adhar_no' => $request->adhar_no ?? $member->adhar_no,
            'address' => $request->address ?? $member->address,
            'plan_duration' => $request->plan_duration ?? $member->plan_duration,
            'start_date' => $request->start_date ?? $member->start_date,
            'end_date' => $endDate,
            'total_fees' => $request->total_fees,
            'amount_paid' => $finalAmountPaid,
            'status' => $request->status,
        ]);

        return redirect()->route('Partnerjym.members.index')->with('success', 'Gym Member updated successfully!');
    }

    /**
     * Generate HTML Printable Invoice
     */
    public function invoice($uuid)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $member = GymMember::with('gym')->where('uuid', $uuid)->where('partner_id', $partnerId)->firstOrFail();
        return view('partner.members.invoice', compact('member'));
    }

    /**
     * Generate HTML Printable ID Card
     */
    public function idCard($uuid)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $member = GymMember::with('gym')->where('uuid', $uuid)->where('partner_id', $partnerId)->firstOrFail();
        return view('partner.members.id_card', compact('member'));
    }

    public function destroy($uuid)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $member = GymMember::where('uuid', $uuid)->where('partner_id', $partnerId)->firstOrFail();
        $member->delete();

        return back()->with('success', 'Member deleted successfully.');
    }
}
