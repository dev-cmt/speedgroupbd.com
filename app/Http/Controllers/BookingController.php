<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\TourPackage;
use App\Models\User;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('user', 'tourPackage')->paginate(10);
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $tourPackages = TourPackage::all();
        return view('bookings.create', compact('users', 'tourPackages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:tour_packages,id',
            'start_date' => 'required|date|after:today',
            'persons' => 'required|integer|min:1',
            'total_cost' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Confirmed,Cancelled,Completed',
        ]);

        Booking::create($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $booking->load('user', 'tourPackage');
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $users = User::all();
        $tourPackages = TourPackage::all();
        return view('bookings.edit', compact('booking', 'users', 'tourPackages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:tour_packages,id',
            'start_date' => 'required|date|after:today',
            'persons' => 'required|integer|min:1',
            'total_cost' => 'required|numeric|min:0',
            'status' => 'required|in:Pending,Confirmed,Cancelled,Completed',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')
            ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Get bookings by user
     */
    public function getByUser($userId)
    {
        $bookings = Booking::where('user_id', $userId)->with('tourPackage')->get();
        return response()->json($bookings);
    }

    /**
     * Get bookings by package
     */
    public function getByPackage($packageId)
    {
        $bookings = Booking::where('package_id', $packageId)->with('user')->get();
        return response()->json($bookings);
    }
}
