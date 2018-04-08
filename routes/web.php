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



Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['middleware' => ['auth', 'isAdmin'] ], function () {
	// POS Controller
	Route::get('/pos', 'PosController@index');
	Route::post('/pos/add', 'PosController@create');

	// Customer Controller
	Route::get('/customer', 'CustomerController@index');
	Route::get('/customer/add', 'CustomerController@add');
	Route::post('/customer/add', 'CustomerController@create');
	Route::get('/customer/{slug}', 'CustomerController@edit');
	Route::post('/customer/{slug}', 'CustomerController@update');

	// Product Tab
		// Product Controller
		Route::get('/product', 'ProductController@index');
		Route::get('/product/add', 'ProductController@add');
		Route::post('/product/add', 'ProductController@create');
		Route::get('/product/edit', 'ProductController@edit');
		Route::post('/product/edit', 'ProductController@update');

		// Inventory Controller
		Route::get('/inventory', 'InventoryController@index');
		Route::get('/inventory/add', 'InventoryController@add');
		Route::post('/inventory/add', 'InventoryController@create');
		Route::get('/inventory/edit', 'InventoryController@edit');
		Route::post('/inventory/edit', 'InventoryController@update');
		Route::get('/inventory/stockout', 'InventoryController@stockout');
		Route::post('/inventory/stockout', 'InventoryController@stockout_update');

		// Main Category Controller
		Route::get('/main_category', 'MainCategoryController@index');
		Route::get('/main_category/add', 'MainCategoryController@add');
		Route::post('/main_category/add', 'MainCategoryController@create');
		Route::get('/main_category/edit', 'MainCategoryController@edit');
		Route::post('/main_category/edit', 'MainCategoryController@update');

		// Sub Category Controller
		Route::get('/sub_category', 'SubCategoryController@index');
		Route::get('/sub_category/add', 'SubCategoryController@add');
		Route::post('/sub_category/add', 'SubCategoryController@create');
		Route::get('/sub_category/edit', 'SubCategoryController@edit');
		Route::post('/sub_category/edit', 'SubCategoryController@update');

		// Brand Controller
		Route::get('/brand', 'BrandController@index');
		Route::get('/brand/add', 'BrandController@add');
		Route::post('/brand/add', 'BrandController@create');
		Route::get('/brand/edit', 'BrandController@edit');
		Route::post('/brand/edit', 'BrandController@update');

	// Sales Tab
		// Sales Controller
		Route::get('/service_sales', 'SalesController@service_sales');
		Route::get('/product_sales', 'SalesController@product_sales');


	// Mail Tab
		// Mail Box Controller
		Route::get('/mail', 'MailBoxController@index');
		Route::get('/mail/compose', 'MailBoxController@compose');

	// INSERT HERE THE REPORTS CONTROLLER

	// Gym Management Tab
		// Gym Information Controller
		Route::get('/gym_information', 'GymInformationController@index');
		Route::post('/gym_information', 'GymInformationController@update');
		
		// Branch Controller
		Route::get('/branch', 'BranchController@index');
		Route::get('/branch/add', 'BranchController@add');
		Route::post('/branch/add', 'BranchController@create');
		Route::get('/branch/edit', 'BranchController@edit');
		Route::post('/branch/edit', 'BranchController@update');
		
		// Employee Controller
		Route::get('/employee', 'EmployeeController@index');
		Route::get('/employee/add', 'EmployeeController@add');
		Route::post('/employee/add', 'EmployeeController@create');
		Route::get('/employee/edit', 'EmployeeController@edit');
		Route::post('/employee/edit', 'EmployeeController@update');

		// Membership Plan Controller
		Route::get('/membership_plan', 'MembershipPlanController@index');
		Route::get('/membership_plan/add', 'MembershipPlanController@add');
		Route::post('/membership_plan/add', 'MembershipPlanController@create');
		Route::get('/membership_plan/edit', 'MembershipPlanController@edit');
		Route::post('/membership_plan/edit', 'MembershipPlanController@update');

		// Session Plan Controller
		Route::get('/session_fee', 'SessionFeeController@index');
		Route::get('/session_fee/add', 'SessionFeeController@add');
		Route::post('/session_fee/add', 'SessionFeeController@create');
		Route::get('/session_fee/edit', 'SessionFeeController@edit');
		Route::post('/session_fee/edit', 'SessionFeeController@update');
});