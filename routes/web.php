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

// Route::get('/sf', 'CheckSheetBPKBController@sf')->name('sf');
Route::get('/logout', 'Auth\LoginController@logout');


// !ADMIN AREA.
Route::middleware(['auth', 'auth.admin'])->group(function(){
    Route::prefix('admin')->as('admin.')->namespace('Admin')->group(function(){

        Route::prefix('sipedas')->as('sipedas.')->namespace('Sipedas')->group(function(){
    
            Route::resource('/master-document', 'MasterDocumentController');
            Route::resource('/document', 'DocumentController');
    
        });
    
        Route::get('/', 'AdminController@index')->name('home');
    });
});


// !USER AREA.
Route::middleware(['auth', 'auth.user'])->group(function(){

    Route::prefix('sipedas')->as('sipedas.')->namespace('Sipedas')->group(function(){

        Route::get('/document/update-document-download-count', 'DocumentController@UpdateDocumentDownloadCount')->name('document.update-document-download-count');
        Route::resource('/document', 'DocumentController');

    });
    
    Route::get('/', 'HomeController@index')->name('home');
});
