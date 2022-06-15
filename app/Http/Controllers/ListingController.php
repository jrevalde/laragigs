<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Symfony\Component\CssSelector\Node\FunctionNode;

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
            'listings' => Listing::latest()->filter(request(['tag']))->paginate(4) //this sorts the listing by the latest. it's the same as using all() but sorted
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

    //our method for creating a listing

    public function create()
    {
        return view('listings.create');
    }

    //store listing data
    public function store(Request $request)
    {
        //dd($request->all()); just a sanity check

        //Valiation in Laravel is made easy. Only 2 steps.

        $formfields = $request->validate([  //we can specify what rules we want for certain fields. 
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]); //if any of these fail, it will send back an error to the view.


        //check if there was an image uploaded
        if($request->hasFile('logo'))
        {
            $formfields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formfields['user_id'] = auth()->id();

        //if it passes validation we want to create a new row in the database.
        Listing::create($formfields);

         //Create a flash message for confirmation. it is stored in memory for one page load. You can also use message, success, error etc 
        return redirect('/')->with('success', 'Listing Successfully Created');
        //however we still need somewhere in our view to actually show it.
    }

    //Show edit form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    //update the listing as well as update the database row
    public function update(Request $request, Listing $listing)
    {
        $formfields = $request->validate([   
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);


       
        if($request->hasFile('logo'))
        {
            $formfields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        
        $listing->update($formfields);

        
        return back()->with('success', 'Listing Successfully Updated');
        
    }

    public function destroy(Listing $listing)
    {   
        $listing->delete();

        return redirect('/')->with('success', 'Listing was successfully deleted');
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