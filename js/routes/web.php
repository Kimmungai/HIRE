<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/','users@index');

Route::get('client_order_view_all','users@client_orders_all')->middleware('client');

Route::post('set_pass','users@set_pass');

Route::get('open_client_bids','users@open_client_bids')->middleware('client');
Route::get('closed_client_bids','users@closed_client_bids')->middleware('client');
Route::get('client_order_view/{order_id}','users@client_order')->middleware('client');
Route::get('mypage','users@client_myapage')->middleware('auth');
Route::post('update_reg_details','users@update_reg_details')->middleware('auth');
Route::post('update_password','users@update_password')->middleware('auth');
Route::get('cancel_order/{order_id}','users@cancel_order')->middleware('client');;

Route::get('new_order_check', function () {
    return view('new_order_check');
})->middleware('client');

Route::get('/new_order','orders@new')->middleware('client');
Route::post('/new_order','orders@new_order_confirm')->middleware('client');
Route::get('/save_new_order','orders@create')->middleware('client');

Route::post('/registering','users@create');

Route::get('register_confirmation', function () {
    return view('register_confirmation');
});
Route::get('registering', function () {
    return view('registering');
});

Route::get('company_order_view_all','orders@all_orders')->middleware('company');
Route::post('bid','orders@bid')->middleware('company');
Route::post('bid_with_message','orders@bid_with_message')->middleware('company');
Route::get('open-bids', 'orders@open_bids')->middleware('company');
Route::get('closed-bids', 'orders@closed_bids')->middleware('company');
Route::get('company_order_view/{order_id}','orders@view_order')->middleware('company');

Auth::routes();
Route::get('register/verify/{token}','Auth\RegisterController@verify');


Route::get('/home', 'HomeController@index');

Route::get('admin', function () {
    return view('admin.client-accounts');
})->middleware('admin');
Route::get('admin-company-accounts', function () {
    return view('admin.company-accounts');
})->middleware('admin');
Route::get('admin-client-accounts', function () {
    return view('admin.client-accounts');
})->middleware('admin');
Route::get('admin-orders', function () {
    return view('admin.orders');
})->middleware('admin');
Route::get('admin-transactions', function () {
    return view('admin.transactions');
})->middleware('admin');
Route::get('admin-message-hist', function () {
    return view('admin.message-hist');
})->middleware('admin');
Route::get('admin-trash', function () {
    return view('admin.trash');
})->middleware('admin');
Route::get('admin-company-accounts-details', function () {
    return view('admin.company-accounts-details');
})->middleware('admin');
Route::get('admin-message-details', function () {
    return view('admin.message-details');
})->middleware('admin');
Route::get('admin-order-details', function () {
    return view('admin.order-details');
})->middleware('admin');
Route::get('admin-client-accounts-details', function () {
    return view('admin.client-accounts-details');
})->middleware('admin');
Route::get('admin-transactions-details', function () {
    return view('admin.transactions-details');
})->middleware('admin');
Route::get('admin-trash-details', function () {
    return view('admin.trash-details');
})->middleware('admin');
