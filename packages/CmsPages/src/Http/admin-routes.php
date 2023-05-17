<?php


use CmsPages\Http\Controllers\AboutController;
use CmsPages\Http\Controllers\ImageController;


Route::group(['middleware' => ['web', 'admin']], function () {
  Route::prefix(config('app.admin_url'))->group(function () {
  
  Route::view('/page', 'cmspage::admin.index')->name('cmspage.admin.index');


  Route::get('/pages','CmsPages\Http\Controllers\AboutController@fetchAll')->name('fetchAlls');

 
  Route::post('/page', 'CmsPages\Http\Controllers\AboutController@store')
  ->name('stores');


  Route::get('/pagess','CmsPages\Http\Controllers\AboutController@edit')->name('edits');

  Route::delete('/page','CmsPages\Http\Controllers\AboutController@delete')->name('deletes');


  Route::post('admin/page', 'CmsPages\Http\Controllers\AboutController@update')->name('updates');


  // 

  Route::post('/upload-image', [ImageController::class, 'upload'])->name('upload.image');

  });


});
