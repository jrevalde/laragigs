<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //the purpose of both of these functions is:
    
    //show all listings
    public function index()
    {
        //dd(request()); //|| this is called a request a helper and will show what is in the request
        return view('listings.index', //because we have in a listings folder and then in a file called index
        [
            'heading'=> 'Latest Listings',
            'listings' => Listing::latest()->filter(request(['tag']))->get() //this sorts the listing by the latest. it's the same as using all() but sorted
        ]); //we are able to send values over to the view, in this case the variable is $heading.
    }

    //show a single listing
    public function show(Listing $listing) //because we have it in a listings folder and then in a file called show.
    {
        return view('listings.show', 
        [
            'listing' => $listing //we dont need to manually do error handling cos it already comes with the model itself. 
        ]);
    }
}

// Common Naming Conventions:

// index-show all listings
// show - show sing listing
// create - show form to create new Listing 
// store - store a new listing 
// edit - show form to edit listing 
// update - update the listing
// destroy - delete a listing