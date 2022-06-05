<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//in the search bar we have to prefix the url like so {url}/api/posts if we want to access api routes.
/*Route::get('/posts', function(){
    return response()->json([
        'posts' => 
        [
            'title' = "Post one"
        ]
    ]);
});*/
//going to  {url}/api/posts will return the json as a response.

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
