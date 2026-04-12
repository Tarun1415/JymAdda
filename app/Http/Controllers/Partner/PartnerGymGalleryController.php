<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partners\Gym;
use App\Models\Partners\GymGallery;
use Illuminate\Support\Facades\File;

class PartnerGymGalleryController extends Controller
{
    private function getPathPrefix($path = '') {
        $isLocal = in_array(request()->getHost(), ['localhost', '127.0.0.1', '::1']) || str_ends_with(request()->getHost(), '.test');
        return $isLocal ? public_path($path) : base_path($path);
    }

    /**
     * View the gallery management page.
     * Partner can select their gym.
     */
    public function index(Request $request)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        // Fetch all gyms belonging to this partner for the dropdown.
        $gyms = Gym::where('partner_id', $partnerId)->get();

        $selectedGymId = $request->get('gym_id');
        $selectedGym = null;
        $galleries = [];

        // If no gym is selected but they have gyms, default to the first one.
        if (!$selectedGymId && $gyms->count() > 0) {
            $selectedGymId = $gyms->first()->id;
        }

        if ($selectedGymId) {
            $selectedGym = Gym::where('id', $selectedGymId)
                              ->where('partner_id', $partnerId)
                              ->first();
                              
            if ($selectedGym) {
                $galleries = GymGallery::where('gym_id', $selectedGym->id)
                                       ->latest()
                                       ->get();
            }
        }

        return view('partner.jym-listing.gallery', compact('gyms', 'selectedGymId', 'selectedGym', 'galleries'));
    }

    /**
     * Store new images in the gallery limiting to 5 per gym max.
     */
    public function store(Request $request)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $request->validate([
            'gym_id' => 'required|exists:gyms,id',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:3072'
        ]);

        // Validate Ownership
        $gym = Gym::where('id', $request->gym_id)
                  ->where('partner_id', $partnerId)
                  ->firstOrFail();

        // Calculate Image Counting Limits
        $existingCount = GymGallery::where('gym_id', $gym->id)->count();
        $incomingCount = count($request->file('images'));
        
        $totalWillBe = $existingCount + $incomingCount;
        
        if ($totalWillBe > 5) {
            $availableSlots = 5 - $existingCount;
            if ($availableSlots <= 0) {
                return back()->with('error', 'You have already reached the maximum limit of 5 images. Please delete existing images first.');
            }
            return back()->with('error', "Maximum limit is 5. You have $existingCount images. You can only upload $availableSlots more.");
        }

        // Save each image
        if ($request->hasFile('images')) {
            $path = $this->getPathPrefix('uploads/gym_gallery/' . date('Y_m_d'));
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }

            foreach ($request->file('images') as $image) {
                $imageName = $gym->slug . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $imageName);

                $dbPath = 'uploads/gym_gallery/' . date('Y_m_d') . '/' . $imageName;

                GymGallery::create([
                    'gym_id' => $gym->id,
                    'partner_id' => $partnerId,
                    'image_path' => $dbPath,
                ]);
            }
        }

        return back()->with('success', 'Images uploaded successfully.');
    }

    /**
     * Delete an existing gallery image.
     */
    public function destroy($id)
    {
        $partnerId = session('partner_id');
        if (!$partnerId) {
            return redirect()->route('partner.login');
        }

        $gallery = GymGallery::where('id', $id)
                             ->where('partner_id', $partnerId)
                             ->firstOrFail();

        if (File::exists($this->getPathPrefix($gallery->image_path))) {
            File::delete($this->getPathPrefix($gallery->image_path));
        }

        $gallery->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
