<?php
#Auth
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
#Public homepage
Route::get('/', function () {
    return view('pages.welcomeLogOut');
});
#contact list routes
Route::get('contactLists',function(){
    return view('pages.contactLists');
})->name('ContactList');

#Excel
Route::get('companies/{company}/pre/export',        'excel_controller@pre');
Route::get('companies/{company}/refined/export',    'excel_controller@refined');
Route::get('companies/{company}/receipts/export',   'excel_controller@receipt');
Route::get('companies/{company}/issues/export',     'excel_controller@issue');
Route::get('exportOpenDataMaterials',               'excel_controller@materials');

#Routes for logged in users
# - Users
//company middleware:registered in kernel.php(checks the company id of user)
Route::group(['middleware'=>['auth', 'company']],function(){
    #Instructions
    Route::get('companies/{company}/instructions',                                                                          'company_controller@instructions');
    Route::get('/instructions',                                                                                             'company_controller@instructions');
    //Admin and manager routes
    //manager middleware:registered in kernel.php(checks user_type_id is 1 or 2)
    Route::group(['middleware'=>['manager']],function(){
        #Create and edit microlocations
        Route::get('companies/{company}/manage/microlocations/create',                                  'microlocation_controller@create');
        Route::get('companies/{company}/manage/microlocations/{microlocation}/edit',                    'microlocation_controller@edit');
        #Edit company
        Route::get('companies/{company}/edit',                                                          'company_controller@edit')->name('companies.edit');
        #Create and edit communities
        Route::post('companies/{company}/manage/communities/community-store',                           'community_controller@store');
        Route::post('companies/{company}/manage/communities/{community}/community-update',              'community_controller@update');
        Route::get('companies/{company}/manage/communities/create',                                     'community_controller@create');
        Route::get('companies/{company}/manage/communities/{community}/edit',                           'community_controller@edit');
        #Edit and create users
        Route::get('companies/{company}/manage/users/create',                                           'user_controller@create');
        Route::get('companies/{company}/manage/users/{user}/edit',                                      'user_controller@edit');
        Route::post('companies/{company}/manage/users/users-store',                                     'user_controller@store');
        Route::post('companies/{company}/manage/users/{user}/users-update',                             'user_controller@update');

        //Admin routes
        //admin middleware:registered in kernel.php(checks if user_type_id is 1)
        Route::group(['middleware'=>['admin']],function(){

            #Manage Pages
            Route::get('companies/{company}/manage', 'company_controller@manage_index');
            #Admin home
            Route::get('/home', 'HomeController@index')->name('pages.home');
            #Materials
            Route::resource('materials',                                                            'materials_controller', ['only' => ['index', 'show', 'create', 'edit']]);
            Route::post('materials/materials-store',                                                'materials_controller@store');
            Route::post('materials/{material}/materials-update',                                    'materials_controller@update');
            Route::post('materials/{material}/materials-destroy',                                   'materials_controller@destroy');
            Route::get('companies',                                                                 'company_controller@index')->name('companies.index');
            Route::get('companies/create',                                                          'company_controller@create')->name('companies_create');
            Route::post('companies/company-store',                                                  'company_controller@store');
            Route::post('companies/{company}/company-update',                                       'company_controller@update');
        });

    });

    Route::post('companies/{company}/manage/microlocations/microlocations-store',                   'microlocation_controller@store');
    Route::post('companies/{company}/manage/microlocations/{microlocation}/microlocations-update',  'microlocation_controller@update');
    #Microlocations
    Route::get('companies/{company}/manage/microlocations/',                                        'microlocation_controller@index');
    Route::get('companies/{company}',                                                               'company_controller@show')->name('companies.show');
    Route::get('ewc','ewc_controller@index');

    # Users
    Route::resource('companiesUser',                                                                'companyUser_controller', ['only' => ['index']]);
    Route::get('companies/{company}/manage/users',                                                  'user_controller@index');

    # Communities
    Route::get('companies/{company}/manage/communities',                                            'community_controller@index');

    #Reports
    Route::get('companies/{company}/warehouse', 'company_controller@warehouse_index');

    # Receipts
    Route::get('companies/{company}/receipts',                                                      'receipt_controller@index');
    Route::resource('companies/{company}/manage/receipts',                                          'receipt_controller', ['only' => ['show', 'create', 'edit']]);
    Route::get('companies/{company}/receipts/search',                                               'receipt_controller@search');
    Route::post('companies/{company}/manage/receipts/receipts-store',                               'receipt_controller@store');
    Route::post('companies/{company}/manage/receipts/{receipt}/receipts-update',                    'receipt_controller@update');
    Route::get('companies/{company}/manage/receipts/create/source',                                 'receipt_controller@source');
    Route::get('companies/{company}/manage/receipts/create/communities',                            'receipt_controller@communities');
    Route::get('companies/{company}/manage/receipts/{receipt}/edit/source',                         'receipt_controller@source');
    Route::get('companies/{company}/manage/receipts/{receipt}/edit/communities',                    'receipt_controller@communities');

    # Refine Sorting
    Route::get('companies/{company}/refined',                                                       'refined_controller@index');
    Route::get('companies/{company}/manage/refined/create',                                         'refined_controller@create');
    Route::get('companies/{company}/manage/refined/{refined}/edit',                                 'refined_controller@edit');
    Route::get('companies/{company}/refined/search',                                                'refined_controller@search');
    Route::get('companies/{company}/manage/refined/create/origin',                                  'refined_controller@origin');
    Route::get('companies/{company}/manage/refined/{refined}/edit/origin',                          'refined_controller@origin');
    Route::post('companies/{company}/manage/refined/refined-store',                                 'refined_controller@store');
    Route::post('companies/{company}/manage/refined/{refined}/refined-update',                      'refined_controller@update');

    # Pre Sorting
    Route::get('companies/{company}/pre',                                                           'pre_controller@index');
    Route::get('companies/{company}/manage/pre/create',                                             'pre_controller@create');
    Route::get('companies/{company}/manage/pre/{pre}/edit',                                         'pre_controller@edit');
    Route::get('companies/{company}/pre/search',                                                    'pre_controller@search');
    Route::get('companies/{company}/manage/pre/create/receipt',                                     'pre_controller@receipt');
    Route::get('companies/{company}/manage/pre/{pre}/edit/receipt',                                 'pre_controller@receipt');
    Route::post('companies/{company}/manage/pre/pre-store',                                         'pre_controller@store');
    Route::post('companies/{company}/manage/pre/{pre}/pre-update',                                  'pre_controller@update');

    # Issues
    Route::get('companies/{company}/issues',                                                        'issue_controller@index');
    Route::get('companies/{company}/manage/issues/create',                                          'issue_controller@create');
    Route::get('companies/{company}/manage/issues/{issue}/edit',                                    'issue_controller@edit');
    Route::get('companies/{company}/issues/search',                                                 'issue_controller@search');
    Route::get('companies/{company}/manage/issues/inventory',                                       'issue_controller@inventory');
    Route::post('companies/{company}/manage/issues/issues-store',                                   'issue_controller@store');
    Route::post('companies/{company}/manage/issues/{issue}/issues-update',                          'issue_controller@update');

    Route::get('companies/{company}/manage/issues/new_details', function(){
        return view('includes.forms.details');
    });
});
