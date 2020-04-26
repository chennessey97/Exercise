<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::namespace('App\Quote') -> group(function() {
    include('App\Quote.php' );
    include('App\Http\Controllers\UserController.php');

    Route::get('/Quote/quotd', 'UserController@quotd')
        ->with($Quote = new Quote(config(['config/QuoteList.php'])));

    Route::get('/Quote/random', function($Quote) {
        $Quote = $this -> random($Quote);
        return view('/webpage') -> with($Quote);
    });


    Route::get('/Quote/search', function($search = 'q', $type = 'string') {
        $searchList = $this -> search($search, $type);
        return view('/webpage')->with(['author' => '', 'quote' => '']);
    } );


    Route::get('/webpage', function() {
        return view('/webpage')->with(['author' => '', 'quote' => '']);
    });

} );





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


?>
