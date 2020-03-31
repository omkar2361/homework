<?php

use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthenticateController@login');
// Route::post('login', function (Request $request) {
//     $request->validate([
//         'email' => 'required',
//         'password' => 'required',
//     ]);

//     $user = User::where('email', $request->email)->first();

//     if (!$user || !Hash::check($request->password, $user->password)) {
//         return response()->json([
//             'error' => "Invalid",
//         ]);
//     }

//     return $user->createToken('my-token')->plainTextToken;
// });

Route::group(['middleware' => ['tenant']], function () {
    //Account routes
    Route::resource('account', 'AccountController');

    //Account categories route
    Route::resource('account-category', 'AccountCategoryController');

    //Transaction route
    Route::resource('transaction', 'TransactionController');

    //Person route
    Route::resource('person', 'PersonController');

    //Unit route
    Route::resource('unit', 'UnitController');

    //Category route
    Route::resource('category', 'CategoryController');

    //Activity route
    Route::resource('activity', 'TimeActivityController');

    //Inventory route
    Route::resource('inventory', 'InventoryController');

    //Service route
    Route::resource('service', 'ServiceController');
});

Route::post('amazon/orders/custom/datatable', 'AmazonOrderController@datatable');
