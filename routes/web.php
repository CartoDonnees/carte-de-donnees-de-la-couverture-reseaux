<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RssController;
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
# La route du flux RSS avec "rss" en préfixe
Route::group([ 'prefix' => 'rss' ], function () {

	// L'URL "exemple.com/rss/courses"
	Route::get("courses", [RssController::class, 'courses'])->name('rss');

});
Route::get('/', function () {
    return view('dashboard');
})->name('new');


Route::get('/Guide', \App\Http\Livewire\About\UserGuide::class)->name('guide');

Route::middleware(['auth:sanctum', 'verified'])->get(
    '/dashboard',
    function () {
        if (Auth::check()) {
            if (Auth::user()->role == 'admin') {
                return view('choice');
            }
            else if(Auth::user()->role == 'orange' || Auth::user()->role == 'moov' || Auth::user()->role == 'mtn'){
                return view('choiceop');
            }
            else {
                return view('dashboard');
            }
        }
    }
)->name('dashboard');
Route::get('/comment',function () {
    return view('layouts.comment-layout');
})->name('comment');

Route::middleware(['auth:sanctum', 'verified', 'accessrole'])->get('/adminDash', \App\Http\Livewire\Admin\Main::class)->name('adminDash');
Route::middleware(['auth:sanctum', 'verified', 'accessrole'])->get('/networkDash', \App\Http\Livewire\Operateur\Main::class)->name('networkDash');
