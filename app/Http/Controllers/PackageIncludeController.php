<?php

namespace App\Http\Controllers;

use App\Models\PackageInclude;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class PackageIncludeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packageIncludes = PackageInclude::with('tourPackage')->paginate(10);
        return view('package-includes.index', compact('packageIncludes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tourPackages = TourPackage::all();
        return view('package-includes.create', compact('tourPackages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:tour_packages,id',
            'item' => 'required|string|max:255',
        ]);

        PackageInclude::create($request->all());

        return redirect()->route('package-includes.index')
            ->with('success', 'Package include item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageInclude $packageInclude)
    {
        $packageInclude->load('tourPackage');
        return view('package-includes.show', compact('packageInclude'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageInclude $packageInclude)
    {
        $tourPackages = TourPackage::all();
        return view('package-includes.edit', compact('packageInclude', 'tourPackages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackageInclude $packageInclude)
    {
        $request->validate([
            'package_id' => 'required|exists:tour_packages,id',
            'item' => 'required|string|max:255',
        ]);

        $packageInclude->update($request->all());

        return redirect()->route('package-includes.index')
            ->with('success', 'Package include item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageInclude $packageInclude)
    {
        $packageInclude->delete();

        return redirect()->route('package-includes.index')
            ->with('success', 'Package include item deleted successfully.');
    }

    /**
     * Get includes by package
     */
    public function getByPackage($packageId)
    {
        $includes = PackageInclude::where('package_id', $packageId)->get();
        return response()->json($includes);
    }
}
