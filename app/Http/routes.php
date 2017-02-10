<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/services', function () {
    return view('pages.services');
});

Route::get('/contact', function () {
    return view('pages.contact');
});

Route::get('/login', 'LoginController@showForm');
Route::post('/login', 'LoginController@login');

Route::get('/logout', 'LoginController@logout');




Route::get( '/admin', 					'AdminController@dashboard');
Route::get( '/admin/form', 				'AdminController@editForm');
Route::post('/admin/form', 				'AdminController@newFormSection');
Route::get( '/admin/form/delete/{id}', 	'AdminController@deleteFormSection');
Route::get( '/admin/form/{id}', 	'AdminController@editFormSection');

Route::post('/admin/form/{secid}/description_area',
										'AdminController@formSectionNewDescriptionArea');
Route::get(' /admin/form/{secid}/description_area/delete/{id}',
										'AdminController@formSectionDeleteDescriptionArea');
Route::post('/admin/form/{secid}/concern_area',
										'AdminController@formSectionNewConcernArea');
Route::get(' /admin/form/{secid}/concern_area/delete/{id}',
										'AdminController@formSectionDeleteConcernArea');