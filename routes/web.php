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
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth', 'XSS', 'timeout']], function() {

	Route::resource('sells', '\App\Http\Controllers\SellController');
	Route::get('sells/{model}/buy', ['as' => 'order', 'uses' => '\App\Http\Controllers\SellController@byColor'])
		->name('sells.color');
	Route::get('sells/{model}/{color}/buy', ['as' => 'order', 'uses' => '\App\Http\Controllers\SellController@byNetwork'])
		->name('sells.network');
	Route::get('sells/{model}/{color}/{network}/buy', ['as' => 'order', 'uses' => '\App\Http\Controllers\SellController@bySize'])
		->name('sells.size');
	Route::get('sells/{model}/{color}/{network}/{size}/buy', ['as' => 'order', 'uses' => '\App\Http\Controllers\SellController@byCondition'])
		->name('sells.condition');
	Route::get('sells/{model}/{color}/{network}/{size}/{condition}/buy', ['as' => 'order', 
		'uses' => '\App\Http\Controllers\SellController@checkout'])
		->name('sells.checkout');




	Route::group(['prefix' => 'admin'], function() {
		Route::get('/', function () {
    		return redirect()->route('dashboards.index');
		});
		Route::resource('dashboards', '\App\Http\Controllers\Admin\DashboardController');
		Route::resource('roles', '\App\Http\Controllers\Admin\RoleController');
		Route::resource('users', '\App\Http\Controllers\Admin\UserController');
		Route::resource('brands', '\App\Http\Controllers\Admin\BrandController');
		Route::resource('carriers', '\App\Http\Controllers\Admin\CarrierController');
		Route::resource('colors', '\App\Http\Controllers\Admin\ColorController');
		Route::resource('sizes', '\App\Http\Controllers\Admin\SizeController');
		Route::resource('conditions', '\App\Http\Controllers\Admin\ConditionController');
		Route::resource('gadgets', '\App\Http\Controllers\Admin\GadgetController');
		Route::resource('devices', '\App\Http\Controllers\Admin\DeviceController');
		Route::resource('parts', '\App\Http\Controllers\Admin\PartController');
		Route::resource('models', '\App\Http\Controllers\Admin\ModelController');
		Route::resource('invoices', '\App\Http\Controllers\Admin\InvoiceController');
		Route::get('/invoices/{id}/followed', '\App\Http\Controllers\Admin\InvoiceController@followed')->name('invoices.followed');
		Route::get('/invoices/{id}/print', '\App\Http\Controllers\Admin\InvoiceController@print')->name('invoices.print');
		Route::get('/invoices/detail/{id}/create', '\App\Http\Controllers\Admin\InvoiceController@createDetail')->name('invoice.detail.create');
		Route::post('/invoices/detail/{id}/store', '\App\Http\Controllers\Admin\InvoiceController@storeDetail')->name('invoice.detail.store');
		Route::patch('/invoices/detail/{id}/{invoice_id}/update', '\App\Http\Controllers\Admin\InvoiceController@updateDetail')->name('invoice.detail.update');
		Route::
			get('/invoices/detail/{id}/{invoice_id}/edit', '\App\Http\Controllers\Admin\InvoiceController@editDetail')
				->name('invoice.detail.edit');
		Route::
			get('/invoices/detail/{id}/{invoice_id}/delete', '\App\Http\Controllers\Admin\InvoiceController@destroyDetail')
				->name('invoice.detail.delete');
	});
});

