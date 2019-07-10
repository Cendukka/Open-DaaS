<?php

# Home
Route::get('/', function () {
	return view('pages.home');
});


# Warehouse page
Route::get('companies/{company}/warehouse', 'company_controller@warehouse_index');


#Manage Pages
Route::get('companies/{company}/manage', 'company_controller@manage_index');
Route::get('/manage', function () {
    return view('pages.manage');
});


# EWC Codes
Route::get('ewc',                           'ewc_controller@index');
Route::get('ewc/create',                    'ewc_controller@create');
Route::get('ewc/{ewc_code}/edit',           'ewc_controller@edit');
Route::post('ewc/ewc-store',                'ewc_controller@store');
Route::post('ewc/{ewc_code}/ewc-update',    'ewc_controller@update');
Route::post('ewc/{ewc_code}/ewc-destroy',   'ewc_controller@destroy');
Route::get('ewc/search',                    'ewc_controller@search');


# Materials
Route::resource('materials',                            'materials_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('materials/materials-store',                'materials_controller@store');
Route::post('materials/{material}/materials-update',    'materials_controller@update');
Route::post('materials/{material}/materials-destroy',   'materials_controller@destroy');


# Companies
Route::resource('companies',                        'company_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/company-store',              'company_controller@store');
Route::post('companies/{company}/company-update',   'company_controller@update');


# Users
Route::resource('companies/{company}/manage/users',                 'user_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/users/users-store',         'user_controller@store');
Route::post('companies/{company}/manage/users/{user}/users-update', 'user_controller@update');


# Microlocations
Route::resource('companies/{company}/manage/microlocations',                                    'microlocation_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/microlocations/microlocations-store',                   'microlocation_controller@store');
Route::post('companies/{company}/manage/microlocations/{microlocation}/microlocations-update',  'microlocation_controller@update');


# Communities
Route::resource('companies/{company}/manage/communities',                           'community_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/communities/community-store',               'community_controller@store');
Route::post('companies/{company}/manage/communities/{community}/community-update',  'community_controller@update');


# Receipts
Route::get('companies/{company}/receipts',                                      'receipt_controller@index');
Route::resource('companies/{company}/manage/receipts',                          'receipt_controller', ['only' => ['show', 'create', 'edit']]);
Route::get('companies/{company}/receipts/search',                               'receipt_controller@search');
Route::post('companies/{company}/manage/receipts/receipts-store',               'receipt_controller@store');
Route::post('companies/{company}/manage/receipts/{receipt}/receipts-update',    'receipt_controller@update');
Route::get('companies/{company}/manage/receipts/create/source',                 'receipt_controller@source');
Route::get('companies/{company}/manage/receipts/create/communities',            'receipt_controller@communities');
Route::get('companies/{company}/manage/receipts/{receipt}/edit/source',         'receipt_controller@source');
Route::get('companies/{company}/manage/receipts/{receipt}/edit/communities',    'receipt_controller@communities');


# Issues
Route::get('companies/{company}/issues',                                'issue_controller@index');
Route::resource('companies/{company}/manage/issues',                    'issue_controller', ['only' => ['show', 'create', 'edit']]);
Route::get('companies/{company}/issues/search',                         'issue_controller@search');
Route::post('companies/{company}/manage/issues/issues-store',           'issue_controller@store');
Route::post('companies/{company}/manage/issues/{issue}/issues-update',  'issue_controller@update');


# Pre Sorting
Route::get('companies/{company}/pre',                           'pre_controller@index');
Route::resource('companies/{company}/manage/pre',               'pre_controller', ['only' => ['show', 'create', 'edit']]);
Route::get('companies/{company}/pre/search',                    'pre_controller@search');
Route::get('companies/{company}/manage/pre/create/receipt',     'pre_controller@receipt');
Route::get('companies/{company}/manage/pre/{pre}/edit/receipt', 'pre_controller@receipt');
Route::post('companies/{company}/manage/pre/pre-store',         'pre_controller@store');
Route::post('companies/{company}/manage/pre/{pre}/pre-update',  'pre_controller@update');


# Refine Sorting
Route::get('companies/{company}/refined',                                   'refined_controller@index');
Route::resource('companies/{company}/manage/refined',                       'refined_controller', ['only' => ['show', 'create', 'edit']]);
Route::get('companies/{company}/refined/search',                            'refined_controller@search');
Route::get('companies/{company}/manage/refined/create/origin',              'refined_controller@origin');
Route::get('companies/{company}/manage/refined/{refined}/edit/origin',      'refined_controller@origin');
Route::post('companies/{company}/manage/refined/refined-store',             'refined_controller@store');
Route::post('companies/{company}/manage/refined/{refined}/refined-update',  'refined_controller@update');