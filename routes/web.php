<?php

Route::get('/', function () {
	return view('pages.home');
});

Route::get('/manage', function () {
	return view('pages.manage');
});

Route::resource('ewc', 'ewc_controller', ['only' => ['index', 'show']]);

Route::resource('companies', 'company_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/company-store', 'company_controller@store');
Route::post('companies/{company}/company-update', 'company_controller@update');



# Company pages
Route::get('companies/{company}/manage', 'company_controller@manage_index');

Route::get('companies/{company}/warehouse', 'company_controller@warehouse_index');

Route::get('companies/{company}/receipts', 'company_controller@receipts_index');

Route::get('companies/{company}/pre', 'company_controller@pre_index');

Route::get('companies/{company}/refined', 'company_controller@refined_index');

Route::get('companies/{company}/issues', 'company_controller@issues_index');



#Company manage pages

Route::resource('companies/{company}/manage/users', 'user_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/users/users-store', 'user_controller@store');
Route::post('companies/{company}/manage/users/{user}/users-update', 'user_controller@update');

Route::resource('companies/{company}/manage/microlocations', 'microlocation_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/microlocations/microlocations-store', 'microlocation_controller@store');
Route::post('companies/{company}/manage/microlocations/{microlocation}/microlocations-update', 'microlocation_controller@update');


