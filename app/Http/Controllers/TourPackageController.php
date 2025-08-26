<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use App\Models\Place;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tourPackages = TourPackage::with('place')->paginate(10);
        return view('tour-packages.index', compact('tourPackages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $places = Place::all();
        return view('tour-packages.create', compact('places'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tour-packages', 'public');
            $data['image'] = $imagePath;
        }

        TourPackage::create($data);

        return redirect()->route('tour-packages.index')
            ->with('success', 'Tour package created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TourPackage $tourPackage)
    {
        $tourPackage->load('place', 'includes', 'bookings');
        return view('tour-packages.show', compact('tourPackage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TourPackage $tourPackage)
    {
        $places = Place::all();
        return view('tour-packages.edit', compact('tourPackage', 'places'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TourPackage $tourPackage)
    {
        $request->validate([
            'place_id' => 'required|exists:places,id',
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($tourPackage->image) {
                Storage::disk('public')->delete($tourPackage->image);
            }

            $imagePath = $request->file('image')->store('tour-packages', 'public');
            $data['image'] = $imagePath;
        }

        $tourPackage->update($data);

        return redirect()->route('tour-packages.index')
            ->with('success', 'Tour package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TourPackage $tourPackage)
    {
        if ($tourPackage->image) {
            Storage::disk('public')->delete($tourPackage->image);
        }

        $tourPackage->delete();

        return redirect()->route('tour-packages.index')
            ->with('success', 'Tour package deleted successfully.');
    }

    /**
     * Get packages by place
     */
    public function getByPlace($placeId)
    {
        $packages = TourPackage::where('place_id', $placeId)->get();
        return response()->json($packages);
    }
}
