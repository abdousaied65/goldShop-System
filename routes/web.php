<?php

use App\Models\SimplCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('supervisor.auth.login');
})->name('index');

$SimplCode = SimplCode::First();
$val = $SimplCode->SimplCode;
if ($val == 1){
    Route::resource('simplified', 'SimplifiedController')->names([
        'index' => 'simplified.index',
        'create' => 'simplified.create',
        'destroy' => 'simplified.destroy',
        'store' => 'simplified.store',
        'edit' => 'simplified.edit',
        'update' => 'simplified.update',
    ]);
    Route::post('/export-simplified', 'SimplifiedController@export_simplified')->name('export.simplified');
    Route::post('delete-element-simplified', 'SimplifiedController@delete_element')->name('delete.element');
    Route::post('delete-simplified', 'SimplifiedController@delete_simplified')->name('delete');
    Route::post('save-simplified', 'SimplifiedController@save_simplified')->name('save');
    Route::post('update-simplified', 'SimplifiedController@update_simplified')->name('update');
    Route::get('print-simplified/{id?}', 'SimplifiedController@print')->name('simplified.print');
    Route::post('search-simplified', 'SimplifiedController@search')->name('simplified.search');
    Route::post('get-branch-employees', 'SimplifiedController@get_branch_employees')
        ->name('get.employees');


    // simplified_return Routes
    Route::resource('simplified_return', 'SimplifiedReturnController')->names([
        'index' => 'simplified_return.index',
        'create' => 'simplified_return.create',
        'store' => 'simplified_return.store',
        'edit' => 'simplified_return.edit',
        'update' => 'simplified_return.update',
        'destroy' => 'simplified_return.destroy',
    ]);

    Route::post('/get-simplified', 'SimplifiedReturnController@get_simplified')
        ->name('get.simplified');

}
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
        'edit' => 'supervisor.simplified.edit',
        'update' => 'supervisor.simplified.update',
    ]);

    Route::get('redirect-to-simplified/{id?}','SimplifiedController@redirector')
        ->name('simplified.redirector');

    Route::post('/export-simplified-excel', 'SimplifiedController@export_simplified_excel')->name('export.simplified.excel');

    Route::post('delete-element-simplified', 'SimplifiedController@delete_element')->name('delete.element.simplified');
    Route::post('delete-simplified', 'SimplifiedController@delete_simplified')->name('delete.simplified');
    Route::post('save-simplified', 'SimplifiedController@save_simplified')->name('save.simplified');
    Route::post('update-simplified', 'SimplifiedController@update_simplified')->name('update.simplified');

    Route::get('print-simplified/{id?}', 'SimplifiedController@print')->name('supervisor.simplified.print');
    Route::post('search-simplified', 'SimplifiedController@search')->name('search.simplified');

    Route::post('get-branch-employees', 'SimplifiedController@get_branch_employees')
        ->name('get.branch.employees');


    // tax Routes
    Route::resource('tax', 'TaxController')->names([
        'index' => 'supervisor.tax.index',
        'create' => 'supervisor.tax.create',
        'destroy' => 'supervisor.tax.destroy',
        'store' => 'supervisor.tax.store',
        'edit' => 'supervisor.tax.edit',
        'update' => 'supervisor.tax.update',
    ]);

    Route::get('redirect-to-tax/{id?}','TaxController@redirector')
        ->name('tax.redirector');

    Route::post('/export-tax-excel', 'TaxController@export_tax_excel')->name('export.tax.excel');

    Route::post('delete-element-tax', 'TaxController@delete_element')->name('delete.element.tax');
    Route::post('delete-tax', 'TaxController@delete_tax')->name('delete.tax');
    Route::post('save-tax', 'TaxController@save_tax')->name('save.tax');
    Route::post('update-tax', 'taxController@update_tax')->name('update.tax');

    Route::get('print-tax/{id?}', 'TaxController@print')->name('supervisor.tax.print');
    Route::post('search-tax', 'TaxController@search')->name('search.tax');


    // purchases Routes
    Route::resource('purchases', 'PurchaseController')->names([
        'index' => 'supervisor.purchases.index',
        'create' => 'supervisor.purchases.create',
        'store' => 'supervisor.purchases.store',
        'edit' => 'supervisor.purchases.edit',
        'update' => 'supervisor.purchases.update',
    ]);

    Route::get('/print-selected-purchases', 'PurchaseController@print_selected')->name('print.selected.purchases');
    Route::post('/export-purchases-excel', 'PurchaseController@export_purchases_excel')->name('export.purchases.excel');


    // simplified_return Routes
    Route::resource('simplified_return', 'SimplifiedReturnController')->names([
        'index' => 'supervisor.simplified_return.index',
        'create' => 'supervisor.simplified_return.create',
        'store' => 'supervisor.simplified_return.store',
        'edit' => 'supervisor.simplified_return.edit',
        'update' => 'supervisor.simplified_return.update',
        'destroy' => 'supervisor.simplified_return.destroy',
    ]);

    Route::post('/get-simplified-details', 'SimplifiedReturnController@get_simplified_details')
        ->name('get.simplified.details');

    // tax_return Routes
    Route::resource('tax_return', 'TaxReturnController')->names([
        'index' => 'supervisor.tax_return.index',
        'create' => 'supervisor.tax_return.create',
        'store' => 'supervisor.tax_return.store',
    ]);

    Route::post('/get-tax-details', 'TaxReturnController@get_tax_details')
        ->name('get.tax.details');

    // employees Routes
    Route::resource('employees', 'EmployeeController')->names([
        'index' => 'supervisor.employees.index',
        'create' => 'supervisor.employees.create',
        'update' => 'supervisor.employees.update',
        'destroy' => 'supervisor.employees.destroy',
        'edit' => 'supervisor.employees.edit',
        'store' => 'supervisor.employees.store',
        'show' => 'supervisor.employees.show',
    ]);
    Route::post('/remove-selected-employees', 'EmployeeController@remove_selected')->name('remove.selected.employees');
    Route::get('/print-selected-employees', 'EmployeeController@print_selected')->name('print.selected.employees');
    Route::post('/export-employees-excel', 'EmployeeController@export_employees_excel')->name('export.employees.excel');


    // fixed Routes
    Route::resource('fixed', 'FixedController')->names([
        'index' => 'supervisor.fixed.index',
        'create' => 'supervisor.fixed.create',
        'update' => 'supervisor.fixed.update',
        'destroy' => 'supervisor.fixed.destroy',
        'edit' => 'supervisor.fixed.edit',
        'store' => 'supervisor.fixed.store',
        'show' => 'supervisor.fixed.show',
    ]);
    Route::post('/remove-selected-fixed', 'FixedController@remove_selected')->name('remove.selected.fixed');
    Route::get('/print-selected-fixed', 'FixedController@print_selected')->name('print.selected.fixed');
    Route::post('/export-fixed-excel', 'FixedController@export_fixed_excel')->name('export.fixed.excel');


    // expense Routes
    Route::resource('expense', 'ExpenseController')->names([
        'index' => 'supervisor.expense.index',
        'create' => 'supervisor.expense.create',
        'update' => 'supervisor.expense.update',
        'destroy' => 'supervisor.expense.destroy',
        'edit' => 'supervisor.expense.edit',
        'store' => 'supervisor.expense.store',
        'show' => 'supervisor.expense.show',
    ]);
    Route::post('/remove-selected-expense', 'ExpenseController@remove_selected')->name('remove.selected.expense');
    Route::get('/print-selected-expense', 'ExpenseController@print_selected')->name('print.selected.expense');
    Route::post('/export-expense-excel', 'ExpenseController@export_expenses_excel')->name('export.expense.excel');

    Route::get('/simplified-report1-get','ReportController@simplified_report1_get')->name('simplified.report1.get');
    Route::post('/simplified-report1-print','ReportController@simplified_report1_print')->name('simplified.report1.print');
    Route::post('/simplified-report1-post','ReportController@simplified_report1_post')->name('simplified.report1.post');

    Route::get('/simplified-report2-get','ReportController@simplified_report2_get')->name('simplified.report2.get');
    Route::post('/simplified-report2-print','ReportController@simplified_report2_print')->name('simplified.report2.print');
    Route::post('/simplified-report2-post','ReportController@simplified_report2_post')->name('simplified.report2.post');

    Route::get('/simplified-report3-get','ReportController@simplified_report3_get')->name('simplified.report3.get');
    Route::post('/simplified-report3-print','ReportController@simplified_report3_print')->name('simplified.report3.print');
    Route::post('/simplified-report3-post','ReportController@simplified_report3_post')->name('simplified.report3.post');

    Route::get('/simplified-report4-get','ReportController@simplified_report4_get')->name('simplified.report4.get');
    Route::post('/simplified-report4-print','ReportController@simplified_report4_print')->name('simplified.report4.print');
    Route::post('/simplified-report4-post','ReportController@simplified_report4_post')->name('simplified.report4.post');

    Route::get('/simplified-report5-get','ReportController@simplified_report5_get')->name('simplified.report5.get');
    Route::post('/simplified-report5-print','ReportController@simplified_report5_print')->name('simplified.report5.print');
    Route::post('/simplified-report5-post','ReportController@simplified_report5_post')->name('simplified.report5.post');

    Route::get('/simplified-report6-get','ReportController@simplified_report6_get')->name('simplified.report6.get');
    Route::post('/simplified-report6-print','ReportController@simplified_report6_print')->name('simplified.report6.print');
    Route::post('/simplified-report6-post','ReportController@simplified_report6_post')->name('simplified.report6.post');

    Route::get('/simplified-report7-get','ReportController@simplified_report7_get')->name('simplified.report7.get');
    Route::post('/simplified-report7-print','ReportController@simplified_report7_print')->name('simplified.report7.print');
    Route::post('/simplified-report7-post','ReportController@simplified_report7_post')->name('simplified.report7.post');

    Route::get('/simplified-report8-get','ReportController@simplified_report8_get')->name('simplified.report8.get');
    Route::post('/simplified-report8-print','ReportController@simplified_report8_print')->name('simplified.report8.print');
    Route::post('/simplified-report8-post','ReportController@simplified_report8_post')->name('simplified.report8.post');

    Route::get('/tax-report1-get','ReportController@tax_report1_get')->name('tax.report1.get');
    Route::post('/tax-report1-print','ReportController@tax_report1_print')->name('tax.report1.print');
    Route::post('/tax-report1-post','ReportController@tax_report1_post')->name('tax.report1.post');


    Route::get('/simplifiedreturn-report1-get','ReportController@simplifiedreturn_report1_get')->name('simplifiedreturn.report1.get');
    Route::post('/simplifiedreturn-report1-print','ReportController@simplifiedreturn_report1_print')->name('simplifiedreturn.report1.print');
    Route::post('/simplifiedreturn-report1-post','ReportController@simplifiedreturn_report1_post')->name('simplifiedreturn.report1.post');

    Route::get('/simplifiedreturn-report2-get','ReportController@simplifiedreturn_report2_get')->name('simplifiedreturn.report2.get');
    Route::post('/simplifiedreturn-report2-print','ReportController@simplifiedreturn_report2_print')->name('simplifiedreturn.report2.print');
    Route::post('/simplifiedreturn-report2-post','ReportController@simplifiedreturn_report2_post')->name('simplifiedreturn.report2.post');

    Route::get('/simplifiedreturn-report3-get','ReportController@simplifiedreturn_report3_get')->name('simplifiedreturn.report3.get');
    Route::post('/simplifiedreturn-report3-print','ReportController@simplifiedreturn_report3_print')->name('simplifiedreturn.report3.print');
    Route::post('/simplifiedreturn-report3-post','ReportController@simplifiedreturn_report3_post')->name('simplifiedreturn.report3.post');

    Route::get('/simplifiedreturn-report4-get','ReportController@simplifiedreturn_report4_get')->name('simplifiedreturn.report4.get');
    Route::post('/simplifiedreturn-report4-print','ReportController@simplifiedreturn_report4_print')->name('simplifiedreturn.report4.print');
    Route::post('/simplifiedreturn-report4-post','ReportController@simplifiedreturn_report4_post')->name('simplifiedreturn.report4.post');

    Route::get('/simplifiedreturn-report5-get','ReportController@simplifiedreturn_report5_get')->name('simplifiedreturn.report5.get');
    Route::post('/simplifiedreturn-report5-print','ReportController@simplifiedreturn_report5_print')->name('simplifiedreturn.report5.print');
    Route::post('/simplifiedreturn-report5-post','ReportController@simplifiedreturn_report5_post')->name('simplifiedreturn.report5.post');

    Route::get('/simplifiedreturn-report6-get','ReportController@simplifiedreturn_report6_get')->name('simplifiedreturn.report6.get');
    Route::post('/simplifiedreturn-report6-print','ReportController@simplifiedreturn_report6_print')->name('simplifiedreturn.report6.print');
    Route::post('/simplifiedreturn-report6-post','ReportController@simplifiedreturn_report6_post')->name('simplifiedreturn.report6.post');

    Route::get('/simplifiedreturn-report7-get','ReportController@simplifiedreturn_report7_get')->name('simplifiedreturn.report7.get');
    Route::post('/simplifiedreturn-report7-print','ReportController@simplifiedreturn_report7_print')->name('simplifiedreturn.report7.print');
    Route::post('/simplifiedreturn-report7-post','ReportController@simplifiedreturn_report7_post')->name('simplifiedreturn.report7.post');

    Route::get('/simplifiedreturn-report8-get','ReportController@simplifiedreturn_report8_get')->name('simplifiedreturn.report8.get');
    Route::post('/simplifiedreturn-report8-print','ReportController@simplifiedreturn_report8_print')->name('simplifiedreturn.report8.print');
    Route::post('/simplifiedreturn-report8-post','ReportController@simplifiedreturn_report8_post')->name('simplifiedreturn.report8.post');



    Route::get('/taxreturn-report1-get','ReportController@taxreturn_report1_get')->name('taxreturn.report1.get');
    Route::post('/taxreturn-report1-print','ReportController@taxreturn_report1_print')->name('taxreturn.report1.print');
    Route::post('/taxreturn-report1-post','ReportController@taxreturn_report1_post')->name('taxreturn.report1.post');

    Route::get('/taxreturn-report2-get','ReportController@taxreturn_report2_get')->name('taxreturn.report2.get');
    Route::post('/taxreturn-report2-print','ReportController@taxreturn_report2_print')->name('taxreturn.report2.print');
    Route::post('/taxreturn-report2-post','ReportController@taxreturn_report2_post')->name('taxreturn.report2.post');

    Route::get('/taxreturn-report3-get','ReportController@taxreturn_report3_get')->name('taxreturn.report3.get');
    Route::post('/taxreturn-report3-print','ReportController@taxreturn_report3_print')->name('taxreturn.report3.print');
    Route::post('/taxreturn-report3-post','ReportController@taxreturn_report3_post')->name('taxreturn.report3.post');

    Route::get('/taxreturn-report4-get','ReportController@taxreturn_report4_get')->name('taxreturn.report4.get');
    Route::post('/taxreturn-report4-print','ReportController@taxreturn_report4_print')->name('taxreturn.report4.print');
    Route::post('/taxreturn-report4-post','ReportController@taxreturn_report4_post')->name('taxreturn.report4.post');

    Route::get('/taxreturn-report5-get','ReportController@taxreturn_report5_get')->name('taxreturn.report5.get');
    Route::post('/taxreturn-report5-print','ReportController@taxreturn_report5_print')->name('taxreturn.report5.print');
    Route::post('/taxreturn-report5-post','ReportController@taxreturn_report5_post')->name('taxreturn.report5.post');

    Route::get('/taxreturn-report6-get','ReportController@taxreturn_report6_get')->name('taxreturn.report6.get');
    Route::post('/taxreturn-report6-print','ReportController@taxreturn_report6_print')->name('taxreturn.report6.print');
    Route::post('/taxreturn-report6-post','ReportController@taxreturn_report6_post')->name('taxreturn.report6.post');

    Route::get('/taxreturn-report7-get','ReportController@taxreturn_report7_get')->name('taxreturn.report7.get');
    Route::post('/taxreturn-report7-print','ReportController@taxreturn_report7_print')->name('taxreturn.report7.print');
    Route::post('/taxreturn-report7-post','ReportController@taxreturn_report7_post')->name('taxreturn.report7.post');

    Route::get('/taxreturn-report8-get','ReportController@taxreturn_report8_get')->name('taxreturn.report8.get');
    Route::post('/taxreturn-report8-print','ReportController@taxreturn_report8_print')->name('taxreturn.report8.print');
    Route::post('/taxreturn-report8-post','ReportController@taxreturn_report8_post')->name('taxreturn.report8.post');

    # تقارير الاقرار الضريبى

    Route::get('/declaration-report1-get','ReportController@declaration_report1_get')->name('declaration.report1.get');
    Route::post('/declaration-report1-print','ReportController@declaration_report1_print')->name('declaration.report1.print');
    Route::post('/declaration-report1-post','ReportController@declaration_report1_post')->name('declaration.report1.post');


    Route::get('/declaration-report2-get','ReportController@declaration_report2_get')->name('declaration.report2.get');
    Route::post('/declaration-report2-print','ReportController@declaration_report2_print')->name('declaration.report2.print');
    Route::post('/declaration-report2-post','ReportController@declaration_report2_post')->name('declaration.report2.post');


    Route::get('/declaration-report3-get','ReportController@declaration_report3_get')->name('declaration.report3.get');
    Route::post('/declaration-report3-print','ReportController@declaration_report3_print')->name('declaration.report3.print');
    Route::post('/declaration-report3-post','ReportController@declaration_report3_post')->name('declaration.report3.post');


    Route::get('/declaration-report4-get','ReportController@declaration_report4_get')->name('declaration.report4.get');
    Route::post('/declaration-report4-print','ReportController@declaration_report4_print')->name('declaration.report4.print');
    Route::post('/declaration-report4-post','ReportController@declaration_report4_post')->name('declaration.report4.post');


    Route::get('/declaration-report5-get','ReportController@declaration_report5_get')->name('declaration.report5.get');
    Route::post('/declaration-report5-print','ReportController@declaration_report5_print')->name('declaration.report5.print');
    Route::post('/declaration-report5-post','ReportController@declaration_report5_post')->name('declaration.report5.post');

    Route::get('/declaration-report6-get','ReportController@declaration_report6_get')->name('declaration.report6.get');
    Route::post('/declaration-report6-print','ReportController@declaration_report6_print')->name('declaration.report6.print');
    Route::post('/declaration-report6-post','ReportController@declaration_report6_post')->name('declaration.report6.post');

    Route::get('/reports','ReportController@reports')->name('reports');
    Route::post('/get-sales-details','HomeController@get_sales_details')->name('get.sales.details');





});
?>
