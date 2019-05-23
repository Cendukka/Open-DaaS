<?php

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
	return view('pages.home');
});

Route::get('/manage', function () {
	return view('pages.manage');
});


Route::resource('companies', 'company_controller', ['only' => [
	'index', 'show'
]]);

Route::resource('companies', 'company_controller', ['except' => [
	'create', 'store', 'update', 'destroy'
]]);