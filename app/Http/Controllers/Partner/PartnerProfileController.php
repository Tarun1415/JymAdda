<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Partner;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PartnerProfileController extends Controller
{
    private function getPathPrefix($path = '') {
        $isLocal = in_array(request()->getHost(), ['localhost', '127.0.0.1', '::1']) || str_ends_with(request()->getHost(), '.test');
        return $isLocal ? public_path($path) : base_path($path);
    }

    public function Partnerprofile(Request $request, $token)
    {
        // ✅ login check
        if (!session()->has('partner_id')) {
            return redirect()->route('partner.login')->with('error', 'Please login to continue.');
        }

        // ✅ must match logged-in partner + token
        $partner = Partner::where('partner_id', session('partner_id'))
            ->where('token', $token)
            ->first();

        if (!$partner) {
            abort(403, 'Unauthorized access');
        }

        // ✅ GET request => show page
        if ($request->isMethod('get')) {
            return view('partner.partner-profile.profile', compact('partner'));
        }

        // ✅ POST request => update by action_type
        $action = $request->input('action_type');

        // ===============================
        // 1) UPDATE PERSONAL INFO
        // ===============================
        if ($action === 'info') {

            $request->validate([
                'name'          => 'required|string|max:255',
                'mobile'        => 'required|digits:10',
                'email'         => 'required|email|max:255',
                'date_of_birth' => 'nullable|date',
                'address'       => 'nullable|string',
                'state'         => 'nullable|string|max:255',
                'city'          => 'nullable|string|max:255',
            ]);

            $partner->update([
                'name'          => $request->name,
                'mobile'        => $request->mobile,
                'email'         => $request->email,
                'date_of_birth' => $request->date_of_birth,
                'address'       => $request->address,
                'state'         => $request->state,
                'city'          => $request->city,
            ]);

            return back()->with('success', 'Profile updated successfully.');
        }

        // ===============================
        // 2) UPDATE PROFILE IMAGE
        // ===============================
        if ($action === 'image') {

            $request->validate([
                'partner_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $safeName = Str::slug($partner->name ?: 'partner');
            $folder   = "partner/profile/{$safeName}";
            $path     = $this->getPathPrefix($folder);

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file     = $request->file('partner_image');
            $fileName = 'profile-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $partner->update([
                'partner_image' => "{$folder}/{$fileName}",
            ]);

            return back()->with('success', 'Profile image updated successfully.');
        }

        // ===============================
        // 3) UPDATE AADHAAR DOCUMENT
        // ===============================
        if ($action === 'document') {

            $request->validate([
                'aadhaar_card' => 'required|mimes:jpg,jpeg,png,webp,pdf|max:5120',
            ]);

            $safeName = Str::slug($partner->name ?: 'partner');
            $folder   = "partner/document/{$safeName}";
            $path     = $this->getPathPrefix($folder);

            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            $file     = $request->file('aadhaar_card');
            $fileName = 'aadhaar-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($path, $fileName);

            $partner->update([
                'aadhaar_card' => "{$folder}/{$fileName}",
            ]);

            return back()->with('success', 'Aadhaar document uploaded successfully.');
        }

        // ===============================
        // 4) UPDATE PASSWORD
        // ===============================
        if ($action === 'password') {
            $request->validate([
                'current_password'      => 'required',
                'new_password'          => 'required|min:8|confirmed',
            ]);

            if (!Hash::check($request->current_password, $partner->password)) {
                return back()->with('error', 'Current password does not match.');
            }

            $partner->update([
                'password' => Hash::make($request->new_password)
            ]);

            return back()->with('success', 'Password updated successfully.');
        }

        // fallback
        return back()->with('error', 'Invalid request.');
    }
}
