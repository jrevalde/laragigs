<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

//Show all listings
Route::get('/', [ListingController::class, 'index']);

//This will store listing data
Route::post('/listings', [ListingController::class, 'store']);

//this approach uses route-model-binding.
Route::get('/listings/listing/{listing}', [ListingController::class, 'show']);

//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth'); //we add the auth middleware to wherever we don't want guests to access.

//Show edit form
Route::get('/listings/listing/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//delete a listing
Route::delete('/listings/listing/{listing}/delete', [ListingController::class, 'destroy'])->middleware('auth'); //destroy is the naming convention for deleting.

//Update the database with the new fields from edit form
Route::put('/listings/listing/{listing}', [ListingController::class, 'update'])->middleware('auth');

//show register create form
Route::get('/register', [UserController::class, 'register'])->middleware('guest'); //we can put guest middleware in the routes that guests can access.

//Create new user
Route::post('/users', [UserController::class, 'store']);

//Log user Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show the login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest'); //we can give our route a name

//login the user
Route::post('users/authenticate', [UserController::class, 'authenticate']);

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



