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

// +~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~+
// |                                          |
// |        ****    PUBLIC PAGES   ****       |
// |                                          |
// +~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~+

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



// +~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~+
// |                                          |
// |         ****    ADMIN PAGE   ****        |
// |                                          |
// +~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~+


Route::get( '/admin', 				'AdminController@dashboard');

// +-------------------------------------+
// |           Form Editing              |
// +-------------------------------------+

Route::get( '/admin/form', 			'AdminController@editForm');
Route::post('/admin/form', 			'AdminController@newFormSection');
Route::get( '/admin/form/delete/{id}', 	'AdminController@deleteFormSection');
Route::get( '/admin/form/{id}', 	'AdminController@editFormSection');

Route::post('/admin/form/{secid}/description_area',
									'AdminController@formSectionNewDescriptionArea');
Route::get( '/admin/form/{secid}/description_area/delete/{id}',
									'AdminController@formSectionDeleteDescriptionArea');
Route::post('/admin/form/{secid}/concern_area',
									'AdminController@formSectionNewConcernArea');
Route::get( '/admin/form/{secid}/concern_area/delete/{id}',
									'AdminController@formSectionDeleteConcernArea');

Route::get( '/admin/form/{secid}/description_area/{id}',
									'AdminController@formSectionEditDescriptionArea');
Route::post('/admin/form/{secid}/description_area/{descid}',
									'AdminController@formSectionNewDescriptionOption');
Route::get( '/admin/form/{secid}/description_area/{descid}/option/{id}/delete',
									'AdminController@formSectionDeleteDescriptionOption');

Route::get( '/admin/form/{secid}/concern_area/{id}',
									'AdminController@formSectionEditConcernArea');
Route::post('/admin/form/{secid}/concern_area/{conid}',
									'AdminController@formSectionNewConcernOption');
Route::get( '/admin/form/{secid}/concern_area/{conid}/option/{id}/delete',
									'AdminController@formSectionDeleteConcernOption');

// +-------------------------------------+
// |          Report Editing             |
// +-------------------------------------+

Route::get( '/admin/new',						'ReportController@newReport');
Route::get( '/admin/report/{id}',				'ReportController@editReport');
Route::get( '/admin/report/{id}/details',		'ReportController@editReportDetails');
Route::post('/admin/report/{id}/details',		'ReportController@saveReportDetails');
Route::get( '/admin/report/{id}/summary',		'ReportController@editReportSummary');
Route::post('/admin/report/{id}/summary',		'ReportController@saveReportSummary');
Route::get( '/admin/report/{reportid}/{id}',	'ReportController@editReportSection');
Route::post('/admin/report/{reportid}/{id}',	'ReportController@saveReportSection');
Route::post('/admin/report/{reportid}/{id}/image',	'ReportController@addSectionImage');
Route::get( '/admin/report/{reportid}/{secid}/image/{id}/delete',	'ReportController@deleteImage');




Route::get( '/webportal/print/{id}',  	 'PortalController@printReport');