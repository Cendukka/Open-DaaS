<?php
Auth::routes();



Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware'=>['auth']],function(){ //all user routes

    //Home
	Route::get('companies/{company}/manage/microlocations/{microlocation}',                     'microlocation_controller@show');
	//Create and edit microlocations
	Route::get('companies/{company}/manage/microlocations/{microlocation}/create',              'microlocation_controller@create');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/edit',                'microlocation_controller@edit');
	//Microlocation routes
	Route::get('companies/{company}/manage/microlocations/{microlocation}/warehouse',           'microlocation_controller@warehouse_index');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/receipts',            'receipt_controller@index');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/receipts/search',     'receipt_controller@search');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/issues',              'issue_controller@index');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/issues/search',       'issue_controller@search');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/pre',                 'pre_controller@index');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/pre/search',          'pre_controller@search');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/refined',             'refined_controller@index');
	Route::get('companies/{company}/manage/microlocations/{microlocation}/refined/search',      'refined_controller@search');

	Route::get('companies/{company}/warehouse', 'company_controller@warehouse_index');

	Route::group(['middleware'=>['manager']],function(){//Admin and manager routes

        Route::get('companies/{company}/manage/microlocations/',               'microlocation_controller@index');
		Route::get('companies/create', 'company_controller@create')->name('companies.create');
		Route::get('companies/{company}/edit', 'company_controller@edit')->name('companies.edit');
		Route::get('companies/{company}', 'company_controller@show')->name('companies.show');
		Route::get('ewc','ewc_controller@index');

			Route::group(['middleware'=>['admin']],function(){//Admin routes
				#Manage Pages
				Route::get('companies/{company}/manage', 'company_controller@manage_index');
                Route::get('companies', 'company_controller@index')->name('companies.index');

				Route::get('/home', 'HomeController@index')->name('pages.home');
			});

	});
});
Route::get('yahoo', function () {

	return view('yahoo');
});

Route::get('/', function () {
	return view('pages.welcomeLogOut');
});

Route::get('/hallinnoi/lisauusitoimipiste', function () {
	return view('pages.lisaUusiToimipiste');
});

Route::get('/users', 'user_controller@index')->name('users');


// Route::get('ewc','ewc_controller@index');
Route::get('ewc/search','ewc_controller@search');


#contact person routes
Route::get('contactLists',function(){
	return view('pages.contactLists');
})->name('ContactList');
/* Route::get('/companies/{company}/contactPerson',function(){
	return view('pages.contactPerson');
});
Route::get('/companies/{company}/manage/microlocations/{ml}/contactPerson',function(){
	return view('pages.contactPerson');
}); */
//Route::get('contactlist/search');
// Route::get('/manage', function () {
//     return view('pages.manage');
// });








# Report Pages


#Manage Pages
// Route::get('companies/{company}/manage', 'company_controller@manage_index');
// Route::get('/manage', function () {
//     return view('pages.manage');
// });


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
//( Route::resource('companies',                        'company_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/company-store',              'company_controller@store');
Route::post('companies/{company}/company-update',   'company_controller@update');


# Users
Route::resource('companiesUser',                                    'companyUser_controller', ['only' => ['index']]);
Route::get('companies/{company}/manage/users',                      'user_controller@index');
Route::get('companies/{company}/manage/users/create',               'user_controller@create');
Route::get('companies/{company}/manage/users/{user}/edit',          'user_controller@edit');
Route::post('companies/{company}/manage/users/users-store',         'user_controller@store');
Route::post('companies/{company}/manage/users/{user}/users-update', 'user_controller@update');


# Microlocations
// Route::resource('companies/{company}/manage/microlocations',                                    'microlocation_controller', ['only' => ['index', 'show', 'create', 'edit']]);
Route::post('companies/{company}/manage/microlocations/microlocations-store',                   'microlocation_controller@store');
Route::post('companies/{company}/manage/microlocations/{microlocation}/microlocations-update',  'microlocation_controller@update');

// Route::get('companies/{company}/manage/microlocation/{microlocation}/warehouse', 'microlocation_controller@warehouse_index');


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
Route::get('companies/{company}/manage/issues/create',                  'issue_controller@create');
Route::get('companies/{company}/manage/issues/{issue}/edit',            'issue_controller@edit');
Route::get('companies/{company}/issues/search',                         'issue_controller@search');
Route::get('companies/{company}/manage/issues/inventory',               'issue_controller@inventory');
Route::post('companies/{company}/manage/issues/issues-store',           'issue_controller@store');
Route::post('companies/{company}/manage/issues/{issue}/issues-update',  'issue_controller@update');
Route::get('companies/{company}/manage/issues/new_details',            function(){return view('includes.forms.details');});

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

#Excel
Route::get('companies/{company}/pre/export',        'excel_controller@pre');
Route::get('companies/{company}/refined/export',    'excel_controller@refined');
Route::get('companies/{company}/receipts/export',   'excel_controller@receipt');
Route::get('companies/{company}/issues/export',     'excel_controller@issue');

