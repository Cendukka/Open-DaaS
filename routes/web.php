<?php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('pages.home');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::get('/', function () {
	return view('pages.welcomeLogOut');
});

Route::get('/manage', function () {
	return view('pages.manage');
});

Route::get('/hallinnoi/lisauusitoimipiste', function () {
	return view('pages.lisaUusiToimipiste');
});


Route::get('ewc','ewc_controller@index');
Route::get('ewc/search','ewc_controller@search');




# Report Pages
Route::get('companies/{company}/warehouse', 'company_controller@warehouse_index');

Route::get('companies/{company}/receipts', 'company_controller@receipts_index');
Route::get('companies/{company}/receipts/search', 'receipt_controller@search');

Route::get('companies/{company}/pre', 'company_controller@pre_index');
Route::get('companies/{company}/pre/search', 'pre_controller@search');

Route::get('companies/{company}/refined', 'company_controller@refined_index');
Route::get('companies/{company}/refined/search', 'refined_controller@search');

Route::get('companies/{company}/issues', 'company_controller@issues_index');
Route::get('companies/{company}/issues/search', 'issue_controller@search');


#Manage Pages
Route::get('companies/{company}/manage', 'company_controller@manage_index');



Route::resource('materials', 'materials_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('materials/materials-store',                'materials_controller@store');
Route::post('materials/{material}/materials-update',    'materials_controller@update');
Route::post('materials/{material}/materials-destroy',   'materials_controller@destroy');

# Companies
Route::resource('companies', 'company_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/company-store',              'company_controller@store');
Route::post('companies/{company}/company-update',   'company_controller@update');

# Users
Route::resource('companiesUser', 'companyUser_controller', ['only' => ['index']]);
Route::resource('companies/{company}/manage/users', 'user_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/users/users-store',         'user_controller@store');
Route::post('companies/{company}/manage/users/{user}/users-update', 'user_controller@update');

# Microlocations
Route::resource('companies/{company}/manage/microlocations', 'microlocation_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/microlocations/microlocations-store',                   'microlocation_controller@store');
Route::post('companies/{company}/manage/microlocations/{microlocation}/microlocations-update',  'microlocation_controller@update');

# Receipts
Route::resource('companies/{company}/manage/receipts', 'receipt_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/receipts/receipts-store', 'receipt_controller@store');
Route::post('companies/{company}/manage/receipts/{receipt}/receipts-update', 'receipt_controller@update');
Route::get('companies/{company}/manage/receipts/create/','receipt_controller@create');
Route::get('companies/{company}/manage/receipts/create/source','receipt_controller@source');
Route::get('companies/{company}/manage/receipts/create/communities','receipt_controller@communities');

#Route::get('/','SearchController@index');
#Route::get('/search','SearchController@search');
