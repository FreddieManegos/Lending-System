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
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/loan','LoanController');
    Route::resource('/collector','CollectorController');
    Route::resource('/payment', 'PaymentController');
    Route::get('/customer', 'CustomerController@index');
    Route::post('/updatePayment','PaymentController@updatePayment');
    Route::post('/updatePayment_2','PaymentController@updatePayment_2');
    Route::get('/getLoan/{id}','LoanController@getLoan');
    Route::get('/customer/pdf/{id}','CustomerController@export_pdf')->name('pdf.customer');
    Route::get('/collector/pdf/{id}','CollectorController@export_pdf')->name('pdf.collector');
    Route::get('/dashboard/sales','HomeController@sales_report')->name('dashboard.sales');
    Route::post('/loan/reloan', 'LoanController@reloan')->name('loan.reloan');
    Route::resource('/backup','BackupController');
});
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

