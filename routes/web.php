<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('supervisor.auth.login');
})->name('index');

// *********  Supervisor Routes ******** //
Route::group(
    [
        'namespace' => 'Supervisor'
    ], function () {
    Auth::routes(
        [
            'verify' => false,
            'register' => false,
        ]
    );
    Route::GET('supervisor/login', 'Auth\LoginController@showLoginForm')->name('supervisor.login');
    Route::POST('supervisor/login', 'Auth\LoginController@login');
    Route::POST('supervisor/logout', 'Auth\LoginController@logout')->name('supervisor.logout');
    Route::GET('supervisor/password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('supervisor.password.confirm');
    Route::POST('supervisor/password/confirm', 'Auth\ConfirmPasswordController@confirm');
    Route::POST('supervisor/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('supervisor.password.email');
    Route::GET('supervisor/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('supervisor.password.request');
    Route::POST('supervisor/password/reset', 'Auth\ResetPasswordController@reset')->name('supervisor.password.update');
    Route::GET('supervisor/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('supervisor.password.reset');
});

Route::group(
    ['middleware' => ['auth:supervisor-web'],
        'prefix' => 'supervisor',
        'namespace' => 'Supervisor'
    ], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/home', 'HomeController@index')->name('supervisor.home');
    Route::get('/lock-screen', 'HomeController@lock_screen')->name('supervisor.lock.screen');

    // Supervisors Routes
    Route::resource('supervisors', 'SupervisorController')->names([
        'index' => 'supervisor.supervisors.index',
        'create' => 'supervisor.supervisors.create',
        'update' => 'supervisor.supervisors.update',
        'destroy' => 'supervisor.supervisors.destroy',
        'edit' => 'supervisor.supervisors.edit',
        'store' => 'supervisor.supervisors.store',
        'show' => 'supervisor.supervisors.show',
    ]);
    Route::post('/remove-selected-supervisors', 'SupervisorController@remove_selected')->name('remove.selected.supervisors');
    Route::get('/print-selected-supervisors', 'SupervisorController@print_selected')->name('print.selected.supervisors');
    Route::post('/export-supervisors-excel', 'SupervisorController@export_supervisors_excel')->name('export.supervisors.excel');

    // SupervisorProfile Routes
    Route::get('profile/edit/{id}', 'SupervisorController@edit_profile')->name('supervisor.profile.edit');
    Route::patch('profile/update/{id}', 'SupervisorController@update_profile')->name('supervisor.profile.update');

    // Roles Routes
    Route::resource('roles', 'RoleController')->names([
        'index' => 'supervisor.roles.index',
        'create' => 'supervisor.roles.create',
        'update' => 'supervisor.roles.update',
        'destroy' => 'supervisor.roles.destroy',
        'edit' => 'supervisor.roles.edit',
        'store' => 'supervisor.roles.store',
    ]);

    // branches Routes
    Route::resource('branches', 'BranchController')->names([
        'index' => 'supervisor.branches.index',
        'create' => 'supervisor.branches.create',
        'update' => 'supervisor.branches.update',
        'destroy' => 'supervisor.branches.destroy',
        'edit' => 'supervisor.branches.edit',
        'store' => 'supervisor.branches.store',
        'show' => 'supervisor.branches.show',
    ]);
    Route::post('/remove-selected-branches', 'BranchController@remove_selected')->name('remove.selected.branches');
    Route::get('/print-selected-branches', 'BranchController@print_selected')->name('print.selected.branches');
    Route::post('/export-branches-excel', 'BranchController@export_branches_excel')->name('export.branches.excel');

    // products Routes
    Route::resource('products', 'ProductController')->names([
        'index' => 'supervisor.products.index',
        'create' => 'supervisor.products.create',
        'update' => 'supervisor.products.update',
        'destroy' => 'supervisor.products.destroy',
        'edit' => 'supervisor.products.edit',
        'store' => 'supervisor.products.store',
        'show' => 'supervisor.products.show',
    ]);
    Route::post('/remove-selected-products', 'ProductController@remove_selected')->name('remove.selected.products');
    Route::get('/print-selected-products', 'ProductController@print_selected')->name('print.selected.products');
    Route::post('/export-products-excel', 'ProductController@export_products_excel')->name('export.products.excel');

    // simplified Routes
    Route::resource('simplified', 'SimplifiedController')->names([
        'index' => 'supervisor.simplified.index',
        'create' => 'supervisor.simplified.create',
        'destroy' => 'supervisor.simplified.destroy',
        'store' => 'supervisor.simplified.store',
    ]);

    Route::post('/export-simplified-excel', 'SimplifiedController@export_simplified_excel')->name('export.simplified.excel');

    Route::post('delete-element-simplified','SimplifiedController@delete_element')->name('delete.element.simplified');
    Route::post('delete-simplified','SimplifiedController@delete_simplified')->name('delete.simplified');
    Route::post('save-simplified','SimplifiedController@save_simplified')->name('save.simplified');

    Route::get('print-simplified/{id?}','SimplifiedController@print')->name('supervisor.simplified.print');
    Route::post('search-simplified','SimplifiedController@search')->name('search.simplified');


    // tax Routes
    Route::resource('tax', 'TaxController')->names([
        'index' => 'supervisor.tax.index',
        'create' => 'supervisor.tax.create',
        'destroy' => 'supervisor.tax.destroy',
        'store' => 'supervisor.tax.store',
    ]);

    Route::post('/export-tax-excel', 'TaxController@export_tax_excel')->name('export.tax.excel');

    Route::post('delete-element-tax','TaxController@delete_element')->name('delete.element.tax');
    Route::post('delete-tax','TaxController@delete_tax')->name('delete.tax');
    Route::post('save-tax','TaxController@save_tax')->name('save.tax');

    Route::get('print-tax/{id?}','TaxController@print')->name('supervisor.tax.print');
    Route::post('search-tax','TaxController@search')->name('search.tax');


});
?>
