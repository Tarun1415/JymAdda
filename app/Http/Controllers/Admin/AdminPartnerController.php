<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Partner;
use Illuminate\Validation\Rule;

class AdminPartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('partners')->ignore($partner->partner_id, 'partner_id')],
            'mobile' => 'required|string|max:20',
            'plan_name' => 'required|string',
            'gym_limit' => 'required|integer|min:1',
            'state' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'aadhaar_card' => 'nullable|string|max:255',
            'plan_expires_at' => 'nullable|date',
        ]);

        $partner->update($request->only([
            'name', 'email', 'mobile', 'plan_name', 'gym_limit', 'state', 'city',
            'address', 'date_of_birth', 'aadhaar_card', 'plan_expires_at'
        ]));

        return redirect()->route('admin.partners.index')->with('success', 'Partner profile updated successfully.');
    }

    public function destroy(Partner $partner)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized. Only Super Admins can delete partners.');
        }

        // Delete Partner (associated gyms and members will be handled by DB foreign keys or left orphaned if not configured)
        $partner->delete();
        
        return redirect()->route('admin.partners.index')->with('success', 'Partner deleted successfully.');
    }
}
