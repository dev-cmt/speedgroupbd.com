<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Continent;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $countries = Country::with(['continent', 'places'])->withCount('places')->paginate(10);
    return view('countries.index', compact('countries'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $continents = Continent::all();
        return view('countries.create', compact('continents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'continent_id' => 'required|exists:continents,id',
            'name' => 'required|string|max:255|unique:countries',
            'slug' => 'required|string|max:255|unique:countries',
        ]);

        Country::create($request->all());

        return redirect()->route('countries.index')
            ->with('success', 'Country created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $country->load(['continent', 'places' => function($query) {
            $query->withCount('tourPackages');
        }]);
        return view('countries.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $continents = Continent::all();
        return view('countries.edit', compact('country', 'continents'));
    }

    /**
     * Update the specified resource in storage.
     */
    // For update method (with file handling)
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'continent_id' => 'required|exists:continents,id',
            'name' => 'required|string|max:255|unique:countries,name,' . $country->id,
            'slug' => 'required|string|max:255|unique:countries,slug,' . $country->id,
            'description' => 'nullable|string',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('flag')) {
            // Delete old flag if exists
            if ($country->flag) {
                Storage::disk('public')->delete($country->flag);
            }

            $flagPath = $request->file('flag')->store('flags', 'public');
            $data['flag'] = $flagPath;
        }

        $country->update($data);

        return redirect()->route('countries.index')
            ->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')
            ->with('success', 'Country deleted successfully.');
    }

    /**
     * Get countries by continent
     */
    public function getByContinent($continentId)
    {
        $countries = Country::where('continent_id', $continentId)->get();
        return response()->json($countries);
    }
}
