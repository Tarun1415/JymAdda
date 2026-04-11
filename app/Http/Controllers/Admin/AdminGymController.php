<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Gym;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminGymController extends Controller
{
    public function index(Request $request)
    {
        $query = Gym::with('partner')->latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('gym_name', 'like', "%{$search}%")
                  ->orWhere('uuid', $search)
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhereHas('partner', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Efficient pagination for large datasets
        $gyms = $query->paginate(20)->withQueryString();
        
        return view('admin.gyms.index', compact('gyms'));
    }

    public function edit(Gym $gym)
    {
        return view('admin.gyms.edit', compact('gym'));
    }

    public function update(Request $request, Gym $gym)
    {
        $request->validate([
            'gym_name'         => 'required|string|max:255',
            'owner_name'       => 'nullable|string|max:255',
            'mobile'           => 'nullable|string|max:20',
            'email'            => 'nullable|email|max:255',
            'status'           => 'required|in:pending,active,rejected',

            'description'      => 'nullable|string',
            'address'          => 'nullable|string|max:500',
            'city'             => 'nullable|string|max:100',
            'state'            => 'nullable|string|max:100',
            'pincode'          => 'nullable|string|max:20',

            'open_days'        => 'nullable|string|max:100',
            
            'gym_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'seo_title'        => 'nullable|string|max:255',
            'seo_description'  => 'nullable|string|max:1000',
            'seo_keywords'     => 'nullable|array',
            'seo_keywords.*'   => 'nullable|string|max:255',
            'seo_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        /* ============ IMAGE UPDATE (Gym Image) ============ */
        $gymImagePath = $gym->gym_image;
        if ($request->hasFile('gym_image')) {
            if (!empty($gym->gym_image) && File::exists(public_path($gym->gym_image))) {
                File::delete(public_path($gym->gym_image));
            }
            $slug = Str::slug($request->gym_name);
            $image = $request->file('gym_image');
            $imageName = $slug . '-' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/gyms');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->move($path, $imageName);
            $gymImagePath = 'uploads/gyms/' . $imageName;
        }

        /* ============ IMAGE UPDATE (SEO Image) ============ */
        $seoImagePath = $gym->seo_image;
        if ($request->hasFile('seo_image')) {
            if (!empty($gym->seo_image) && File::exists(public_path($gym->seo_image))) {
                File::delete(public_path($gym->seo_image));
            }
            $slug = Str::slug($request->gym_name);
            $image = $request->file('seo_image');
            $imageName = $slug . '-seo-' . time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/seo');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $image->move($path, $imageName);
            $seoImagePath = 'uploads/seo/' . $imageName;
        }

        $gym->update([
            'gym_name'   => $request->gym_name,
            'slug'       => Str::slug($request->gym_name),
            'owner_name' => $request->owner_name,
            'mobile'     => $request->mobile,
            'email'      => $request->email,
            'status'     => $request->status,

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
            'seo_keywords'    => json_encode(array_filter($request->input('seo_keywords', []))),
            'seo_image'       => $seoImagePath,
        ]);

        return redirect()->route('admin.gyms.index')->with('success', 'Gym updated successfully.');
    }

    public function destroy(Gym $gym)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized. Only Super Admins can delete gyms.');
        }

        // Delete images
        if (!empty($gym->gym_image) && File::exists(public_path($gym->gym_image))) {
            File::delete(public_path($gym->gym_image));
        }
        if (!empty($gym->seo_image) && File::exists(public_path($gym->seo_image))) {
            File::delete(public_path($gym->seo_image));
        }

        $gym->delete();
        return redirect()->route('admin.gyms.index')->with('success', 'Gym deleted successfully.');
    }
}
