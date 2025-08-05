<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Contact;

class HomeController extends Controller
{

    public function welcome()
    {
        $contact = Contact::where('status', 1)->get();

        return view('welcome', compact('contact'));
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
    public function package()
    {
        return view('frontend.pages.package');
    }
    public function packageArchive()
    {
        return view('frontend.pages.package-archive');
    }
    public function packageDetails()
    {
        return view('frontend.pages.package-details');
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
