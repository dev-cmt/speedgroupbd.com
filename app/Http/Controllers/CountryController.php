<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Continent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::with(['continent', 'places'])->withCount('places')->get();
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
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('flag')) {
            $file = $request->file('flag');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // Move to public/flags
            $file->move(public_path('flags'), $filename);

            $data['flag'] = 'flags/' . $filename; // save relative path
        }

        Country::create($data);

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
            'description' => 'nullable|string',
            'flag' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('flag')) {
            // Delete old file if exists
            if ($country->flag && file_exists(public_path($country->flag))) {
                unlink(public_path($country->flag));
            }

            $file = $request->file('flag');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('flags'), $filename);

            $data['flag'] = 'flags/' . $filename;
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
