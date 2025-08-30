<?php

namespace App\Http\Controllers;

use App\Models\Place;
use App\Models\Country;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::with('country')->paginate(10);
        return view('places.index', compact('places'));
    }

    public function create()
    {
        $countries = Country::all();
        return view('places.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name'       => 'required|string|max:255',
            'description'=> 'nullable|string',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('upload/places'), $imageName);
            $data['image'] = 'upload/places/'.$imageName;
        }

        Place::create($data);

        return redirect()->route('places.index')
            ->with('success', 'Place created successfully.');
    }

    public function show(Place $place)
    {
        $place->load('country', 'tourPackages');
        return view('places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        $countries = Country::all();
        return view('places.edit', compact('place', 'countries'));
    }

    public function update(Request $request, Place $place)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'name'       => 'required|string|max:255',
            'description'=> 'required|string',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($place->image && file_exists(public_path($place->image))) {
                unlink(public_path($place->image));
            }

            $imageName = time().'_'.$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('upload/places'), $imageName);
            $data['image'] = 'upload/places/'.$imageName;
        }

        $place->update($data);

        return redirect()->route('places.index')
            ->with('success', 'Place updated successfully.');
    }

    public function destroy(Place $place)
    {
        if ($place->image && file_exists(public_path($place->image))) {
            unlink(public_path($place->image));
        }

        $place->delete();

        return redirect()->route('places.index')
            ->with('success', 'Place deleted successfully.');
    }

    public function getByCountry($countryId)
    {
        $places = Place::where('country_id', $countryId)->get();
        return response()->json($places);
    }
}
