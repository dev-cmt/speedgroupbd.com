<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Country;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Place::with('country')->paginate(10);
        return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('places.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|max:255|unique:places',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('places', 'public');
            $data['image'] = $imagePath;
        }

        Place::create($data);

        return redirect()->route('places.index')
            ->with('success', 'Place created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Place $place)
    {
        $place->load('country', 'tourPackages');
        return view('places.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Place $place)
    {
        $countries = Country::all();
        return view('places.edit', compact('place', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Place $place)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|max:255|unique:places,slug,' . $place->id,
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($place->image) {
                Storage::disk('public')->delete($place->image);
            }

            $imagePath = $request->file('image')->store('places', 'public');
            $data['image'] = $imagePath;
        }

        $place->update($data);

        return redirect()->route('places.index')
            ->with('success', 'Place updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Place $place)
    {
        if ($place->image) {
            Storage::disk('public')->delete($place->image);
        }

        $place->delete();

        return redirect()->route('places.index')
            ->with('success', 'Place deleted successfully.');
    }

    /**
     * Get places by country
     */
    public function getByCountry($countryId)
    {
        $places = Place::where('country_id', $countryId)->get();
        return response()->json($places);
    }
}
