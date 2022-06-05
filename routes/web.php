<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('listings',
     [
         'heading'=> 'Latest Listings',
         'listings' => Listing::all()
    ]); //we are able to send values over to the view, in this case the variable is $heading.
});

//this approach uses route-model-binding.
Route::get('/listings/listing/{listing}', function(Listing $listing){ //This Route will show a listing instead of all the listings. it does the same thing as the one below.
    return view('listing', 
        [
            'listing' => $listing //we dont need to manually do error handling cos it already comes with the model itself. 
        ]);
});

//this way is the cookie cutter way
// Route::get('/listings/listing/{id}', function($id){ //This Route will show a listing instead of all the listings.

//     $listing = Listing::find($id);

//     if($listing)
//     {   
//         return view('listing', 
//         [
//             'listing' => $listing
//         ]);

//     }
//     else
//     {
//         abort('404');
//     }
   
// });


/*Route::get('/posts{id}', function($id){ //id is the route param
    return response('Post ' . $id);
})->where('id', '[0-9]+'); // the route params can have conditions that limit their range */ 

//e.g the {url}/posts/3 will output Post 3 in the view

/*Route::get('/search', function(Request $request){ //just like in javascript we can set req and res as arguments
    dd($request->name. ' ' . $request->city); // dd(); is a function that dumps whatever we pass into it. there is also ddd();
});*/

//e.g {url}/searchq=name=jethro&city=sydney || this would output jethro sydney in the query params header.