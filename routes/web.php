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

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/personel-takip', function (){
   return view('index');
});

Route::resource('/personel-takip', 'StaffController');
Route::get('/personel-takip/detail/{id}', 'StaffController@staff_details')->name('staffDetail');
Route::get('/personel-takip/detail/{id}/add-day', 'StaffController@staff_add_day');
Route::post('/personel-takip/detail/add-day', 'StaffController@staff_add_day_store');
Route::post('/personel-takip/detail/delete-day', 'StaffController@delete_day');
Route::get('/personel-takip/detail/staff-edit-day/{id}', 'StaffController@staff_edit_day');
Route::post('/personel-takip/detail/staff-edit-day', 'StaffController@staff_edit_day_update');
