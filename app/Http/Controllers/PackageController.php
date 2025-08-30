<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\PackageImage;
use App\Models\PackageItinerary;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Helpers\ImageHelper;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::paginate(10);
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        $places = Place::all();
        return view('packages.create', compact('places'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
 
        // Create the package first
        $package = Package::create($request->all());

        // Save itineraries
        if ($request->has('itineraries') && is_array($request->itineraries)) {
            foreach ($request->itineraries as $itineraryData) {

                PackageItinerary::create([
                    'package_id'  => $package->id,
                    'day_number'  => $itineraryData['day_number'] ?? null,
                    'title'       => $itineraryData['title'] ?? null,
                    'description' => $itineraryData['description'] ?? null,
                ]);
            }
        }

        // Handle image uploads
        if ($request->hasFile('images')) {
            $hasDefault = PackageImage::where('package_id', $package->id)
                ->where('is_default', true)
                ->exists();

            foreach ($request->file('images') as $key => $image) {
                if ($path = ImageHelper::uploadImage($image, 'uploads/packages')) {
                    PackageImage::create([
                        'package_id' => $package->id,
                        'image_path' => $path,
                        'is_default' => !$hasDefault && $key === 0, // Set first image as default if none exists
                    ]);
                    
                    // Update hasDefault after creating the first image
                    if (!$hasDefault && $key === 0) {
                        $hasDefault = true;
                    }
                }
            }
        }

        return redirect()->route('packages.index')->with('success', 'Tour package created successfully.');
    }

    public function show(Package $package)
    {
        $package->load('place', 'includes', 'bookings', 'images');
        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        $places = Place::all();
        $package->load('images', 'itineraries');
        return view('packages.edit', compact('package', 'places'));
    }

    public function update(Request $request, Package $package)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $package->update($request->all());

        // Update itineraries: clear & re-insert
        $package->itineraries()->delete();
        if ($request->has('itineraries') && is_array($request->itineraries)) {
            foreach ($request->itineraries as $itineraryData) {

                PackageItinerary::create([
                    'package_id'  => $package->id,
                    'day_number'  => $itineraryData['day_number'] ?? null,
                    'title'       => $itineraryData['title'] ?? null,
                    'description' => $itineraryData['description'] ?? null,
                ]);
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $hasDefault = PackageImage::where('package_id', $package->id)
                ->where('is_default', true)
                ->exists();

            foreach ($request->file('images') as $key => $image) {
                if ($path = ImageHelper::uploadImage($image, 'uploads/packages')) {
                    PackageImage::create([
                        'package_id' => $package->id,
                        'image_path' => $path,
                        'is_default' => !$hasDefault && $key === 0,
                    ]);
                    
                    if (!$hasDefault && $key === 0) {
                        $hasDefault = true;
                    }
                }
            }
        }

        return redirect()->route('packages.index')->with('success', 'Tour package updated successfully.');
    }

    public function destroy(Package $package)
    {
        // Delete associated images
        $images = PackageImage::where('package_id', $package->id)->get();
        foreach ($images as $image) {
            $this->deleteFile($image->image_path);
            $image->delete();
        }

        $package->delete();

        return redirect()->route('packages.index')->with('success', 'Tour package deleted successfully.');
    }

    public function getByPlace($placeId)
    {
        $packages = Package::with('images')->where('place_id', $placeId)->get();
        return response()->json($packages);
    }

    public function deleteImage(PackageImage $image)
    {
        if ($this->deleteFile($image->image_path)) {
            // If deleting the default image, set another image as default
            if ($image->is_default) {
                $otherImage = PackageImage::where('package_id', $image->package_id)
                    ->where('id', '!=', $image->id)
                    ->first();
                
                if ($otherImage) {
                    $otherImage->update(['is_default' => true]);
                }
            }
            
            $image->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Failed to delete image']);
    }

    public function setDefaultImage(Package $package, PackageImage $image)
    {
        // Remove default from all other images of this package
        PackageImage::where('package_id', $package->id)
            ->update(['is_default' => false]);
            
        // Set this image as default
        $image->update(['is_default' => true]);
        
        return response()->json(['success' => true]);
    }

    private function deleteFile($filePath)
    {
        if (!$filePath) {
            return false;
        }
        
        $fullPath = public_path($filePath);
        if (file_exists($fullPath) && is_file($fullPath)) {
            unlink($fullPath);
            return true;
        }
        return false;
    }
}