<?php

Route::get('/', function () {
	return view('pages.home');
});

Route::get('/manage', function () {
	return view('pages.manage');
});

Route::resource('ewc', 'ewc_controller', ['only' => ['index', 'show']]);

Route::resource('companies', 'company_controller', ['only' => ['index', 'show']]);

# Company pages
Route::get('companies/{company}/manage', 'company_controller@manage_index');

Route::get('companies/{company}/warehouse', 'company_controller@warehouse_index');

Route::get('companies/{company}/receipts', 'company_controller@receipts_index');

Route::get('companies/{company}/pre', 'company_controller@pre_index');

Route::get('companies/{company}/refined', 'company_controller@refined_index');

Route::get('companies/{company}/issues', 'company_controller@issues_index');

#Company manage pages
Route::get('companies/{company}/manage/users', 'company_manage_controller@users_index');

Route::get('companies/{company}/manage/microlocations', 'company_manage_controller@microlocations_index');
