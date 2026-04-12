<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Gym;
use Illuminate\Support\Str;
use App\Models\Partners\Partner;
use Illuminate\Support\Facades\File;





class PartnerGymController extends Controller
{
    private function getPathPrefix($path = '') {
        $isLocal = in_array(request()->getHost(), ['localhost', '127.0.0.1', '::1']) || str_ends_with(request()->getHost(), '.test');
        return $isLocal ? public_path($path) : base_path($path);
    }
public function index()
{
    $partnerId = session('partner_id');
    if (!$partnerId) {
        return redirect()->route('partner.login');
    }
    $gyms = Gym::where('partner_id', $partnerId)
                ->latest()
                ->get();

    return view('partner.jym-listing.index', compact('gyms'));
}

public function addJymData()
{
    $partnerId = session('partner_id'); // current partner id
    if (!$partnerId) {
        return redirect()->route('partner.login');
    }

    $partner = Partner::where('partner_id', $partnerId)->first();
    if (!$partner) return redirect()->route('partner.login');

    $planName = strtolower($partner->plan_name ?? 'basic');
    $allowedGymLimit = 1;
    if ($planName === 'standard') {
        $allowedGymLimit = 3;
    } elseif ($planName === 'premium') {
        $allowedGymLimit = 5;
    }

    $alreadyAdded = Gym::where('partner_id', $partnerId)->count();

    if ($alreadyAdded >= $allowedGymLimit) {
        return redirect()->route('Partnerjym.index')->with(
            'error',
            "Your current '" . ucfirst($planName) . "' plan only allows adding up to $allowedGymLimit gym(s). Please upgrade your plan to add more."
        );
    }

    return view('partner.jym-listing.create', compact('partnerId'));
}

public function StoreJymData(Request $request)
{
    $partnerId = session('partner_id');

    if (!$partnerId) {
        return redirect()->route('partner.login');
    }

    // ✅ Partner fetch (gym_limit yahin se aayega)
    $partner = Partner::where('partner_id', $partnerId)->first();

    if (!$partner) {
        return redirect()->route('partner.login');
    }

    // ✅ Resolve Gym Limit based on Plan Name
    $planName = strtolower($partner->plan_name ?? 'basic');
    $allowedGymLimit = 1;
    if ($planName === 'standard') {
        $allowedGymLimit = 3;
    } elseif ($planName === 'premium') {
        $allowedGymLimit = 5;
    }

    // ✅ Total gyms added by partner
    $alreadyAdded = Gym::where('partner_id', $partnerId)->count();

    // 🚫 Limit reached
    if ($alreadyAdded >= $allowedGymLimit) {
        return redirect()->back()->with(
            'error',
            "Your current '" . ucfirst($planName) . "' plan only allows adding up to $allowedGymLimit gym(s). Please upgrade your plan to add more."
        );
    }

    /* ============ IMAGE UPLOAD ============ */

    // Gym image
    $gymImagePath = null;
    if ($request->hasFile('gym_image')) {
        $slug = Str::slug($request->gym_name);
        $image = $request->file('gym_image');

        $imageName = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $this->getPathPrefix('uploads/gyms');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $image->move($path, $imageName);
        $gymImagePath = 'uploads/gyms/' . $imageName;
    }

    // SEO image
    $seoImagePath = null;
    if ($request->hasFile('seo_image')) {
        $slug = Str::slug($request->gym_name);
        $image = $request->file('seo_image');

        $imageName = $slug . '-seo-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $this->getPathPrefix('uploads/seo');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $image->move($path, $imageName);
        $seoImagePath = 'uploads/seo/' . $imageName;
    }

    /* ============ SAVE GYM ============ */

    Gym::create([
        'partner_id' => $partnerId,

        'gym_name'   => $request->gym_name,
        'slug'       => Str::slug($request->gym_name),
        'owner_name' => $request->owner_name,
        'mobile'     => $request->mobile,
        'email'      => $request->email,

        'description' => $request->description,
        'address'     => $request->address,
        'city'        => $request->city,
        'state'       => $request->state,
        'pincode'     => $request->pincode,

       'trainer_available' => $request->boolean('trainer_available'),
        'parking_available' => $request->boolean('parking_available'),
        'ac_available'      => $request->boolean('ac_available'),

        'gym_image' => $gymImagePath,
        'opening_time' => $request->filled('opening_time') ? $request->opening_time : null,
        'closing_time' => $request->filled('closing_time') ? $request->closing_time : null,
        'open_days' => $request->open_days,

        'seo_title'       => $request->seo_title,
        'seo_description' => $request->seo_description,
        'seo_image'       => $seoImagePath,

        // ✅ Default status
        'status' => 'pending',
    ]);

    return redirect()
        ->route('Partnerjym.index')
        ->with('success', 'Gym added successfully. Waiting for admin approval.');
}


public function editJymData($uuid)
{
    $partnerId = session('partner_id');
    if (!$partnerId) {
        return redirect()->route('partner.login');
    }

    $gym = Gym::where('uuid', $uuid)
        ->where('partner_id', $partnerId)
        ->firstOrFail();

    return view('partner.jym-listing.edit', compact('gym'));
}

public function updateJymData(Request $request, $uuid)
{
    $partnerId = session('partner_id');
    if (!$partnerId) {
        return redirect()->route('partner.login');
    }

    $gym = Gym::where('uuid', $uuid)
        ->where('partner_id', $partnerId)
        ->firstOrFail();

    // ✅ Validation
    $request->validate([
        'gym_name'         => 'required|string|max:255',
        'owner_name'       => 'nullable|string|max:255',
        'mobile'           => 'nullable|string|max:20',
        'email'            => 'nullable|email|max:255',

        'description'      => 'nullable|string',
        'address'          => 'nullable|string|max:500',
        'city'             => 'nullable|string|max:100',
        'state'            => 'nullable|string|max:100',
        'pincode'          => 'nullable|string|max:20',

        'trainer_available' => 'nullable',
        'parking_available' => 'nullable',
        'ac_available'      => 'nullable',
        'opening_time'      => 'nullable',
        'closing_time'      => 'nullable',
        'open_days'         => 'nullable|string|max:100',

        'gym_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|',
        'seo_title'        => 'nullable|string|max:255',
        'seo_description'  => 'nullable|string|max:1000',
        'seo_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|',
    ]);

    /* ============ IMAGE UPDATE (Gym Image) ============ */
    $gymImagePath = $gym->gym_image; // default old path
    if ($request->hasFile('gym_image')) {

        // old delete
        if (!empty($gym->gym_image) && File::exists($this->getPathPrefix($gym->gym_image))) {
            File::delete($this->getPathPrefix($gym->gym_image));
        }

        $slug = Str::slug($request->gym_name);
        $image = $request->file('gym_image');

        $imageName = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $this->getPathPrefix('uploads/gyms');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $image->move($path, $imageName);
        $gymImagePath = 'uploads/gyms/' . $imageName;
    }

    /* ============ IMAGE UPDATE (SEO Image) ============ */
    $seoImagePath = $gym->seo_image; // default old path
    if ($request->hasFile('seo_image')) {

        // old delete
        if (!empty($gym->seo_image) && File::exists($this->getPathPrefix($gym->seo_image))) {
            File::delete($this->getPathPrefix($gym->seo_image));
        }

        $slug = Str::slug($request->gym_name);
        $image = $request->file('seo_image');

        $imageName = $slug . '-seo-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $this->getPathPrefix('uploads/seo');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $image->move($path, $imageName);
        $seoImagePath = 'uploads/seo/' . $imageName;
    }

    /* ============ UPDATE GYM ============ */
    $gym->update([
        'gym_name'   => $request->gym_name,
        'slug'       => Str::slug($request->gym_name),

        'owner_name' => $request->owner_name,
        'mobile'     => $request->mobile,
        'email'      => $request->email,

        'description' => $request->description,
        'address'     => $request->address,
        'city'        => $request->city,
        'state'       => $request->state,
        'pincode'     => $request->pincode,

        'trainer_available' => $request->boolean('trainer_available'),
        'parking_available' => $request->boolean('parking_available'),
        'ac_available'      => $request->boolean('ac_available'),

        'gym_image' => $gymImagePath,
        'opening_time' => $request->filled('opening_time') ? $request->opening_time : null,
        'closing_time' => $request->filled('closing_time') ? $request->closing_time : null,
        'open_days' => $request->open_days,

        'seo_title'       => $request->seo_title,
        'seo_description' => $request->seo_description,
        'seo_image'       => $seoImagePath,

        // ✅ agar update ke baad admin approval chahiye
        'status' => 'pending',
    ]);

    return redirect()
        ->route('Partnerjym.index')
        ->with('success', 'Gym updated successfully. Waiting for admin approval.');
}

}
