<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\YoutubeController;
// use Google\Service\YouTube\Resource\Search;

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
    return view('youtube');
});

Route::get('/search', 'YoutubeController@search');
?>