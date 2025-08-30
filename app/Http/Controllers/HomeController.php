<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Contact;
use App\Models\Continent;
use App\Models\Country;
use App\Models\Package;

class HomeController extends Controller
{

    public function welcome()
    {
        $contact = Contact::where('status', 1)->get();
        $continents = Continent::where('status', true)->get();
        

        return view('welcome', compact('contact', 'continents'));
    }
    /**________________________________________________________________________________________
     * About Menu Pages
     * ________________________________________________________________________________________
     */
    public function about()
    {
        return view('frontend.pages.about-us');
    }
    /**________________________________________________________________________________________
     * Packages Pages
     * ________________________________________________________________________________________
     */
    public function package(Request $request, $countrySlug = null)
    {
        $query = Package::with('place.country')
            ->where('status', true)
            ->whereHas('place', function($q) {
                $q->where('status', true);
            });

        $country = null;

        // ✅ Country filter via slug
        if ($countrySlug) {
            $query->whereHas('place.country', function($q) use ($countrySlug) {
                $q->where('slug', $countrySlug)
                  ->where('status', true);
            });

            $country = Country::where('slug', $countrySlug)
                ->where('status', true)
                ->first();
        }

        // ✅ Filtering by price range
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // ✅ Filtering by duration (days)
        if ($request->filled('days')) {
            $query->where('duration_days', $request->days);
        }

        // ✅ Sorting
        switch ($request->sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            default:
                $query->latest();
        }

        // ✅ Paginate results & keep query string
        $packages = $query->paginate(12)->appends($request->query());

        return view('frontend.pages.package', compact('packages', 'country'));
    }
    public function packageDetails($slug)
    {
        $package = Package::where('slug', $slug)
            ->where('status', true)
            ->whereHas('place', function($q) {
                $q->where('status', true);
            })
            ->firstOrFail();
        return view('frontend.pages.package-details', compact('package'));
    }

    public function contact()
    {
        return view('frontend.pages.contact-us');
    }

    public function bookingNow()
    {
        return view('frontend.pages.booking-now');
    }
}
