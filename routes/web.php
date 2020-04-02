<?php

use App\Model\Person;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('react', function () {
    return Inertia::render('Welcome', []);
});
Route::get('home', function () {
    $persons = Person::all();
    return Inertia::render('Home', [
        'persons' => $persons,
    ]);
});
Route::post('login', 'AuthenticateController@login');
