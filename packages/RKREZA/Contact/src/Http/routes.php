<?php


Route::group(['middleware' => ['web', 'admin']], function () {
    Route::prefix(config('app.admin_url'))->group(function () {

    Route::get('admin/contact', 'RKREZA\Contact\Http\Controllers\ContactController@index')
        ->defaults('_config', ['view' => 'contact_view::contact.index'])
        ->name('admin.contact.index');


    Route::get('admin/contact/view/{id}', 'RKREZA\Contact\Http\Controllers\ContactController@view')
        ->defaults('_config', ['view' => 'contact_view::contact.view'])
        ->name('admin.contact.view');


    Route::post('admin/contact/delete/{id}', 'RKREZA\Contact\Http\Controllers\ContactController@destroy')
        ->name('admin.contact.delete');
        
        // 


    // Route::view('/admin/contact-us-data', 'contact_view::contact.position')->name('admin.contact.position');


    Route::get('admin/contact-us-data', 'RKREZA\Contact\Http\Controllers\ContactDataController@index')
        ->defaults('_config', ['view' => 'contact_view::contact.position'])
        ->name('admin.contact.position');

    Route::post('/contact-us-data/{id}', 'RKREZA\Contact\Http\Controllers\ContactDataController@store')
        ->defaults('_config', ['redirect' => 'admin.contact.position'])
        ->name('admin.contact.positiondata');


    Route::post('/contact-us-data', 'RKREZA\Contact\Http\Controllers\ContactusdatafrechController@updatecontact')
    ->defaults('_config', ['redirect' => 'admin.frenchcontact.position'])
    ->name('admin.frenchcontact.positiondata');

    });


    // 
});



Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {

// Registration Routes
    
    Route::get('/contact', 'RKREZA\Contact\Http\Controllers\ContactController@show')
    		->defaults('_config', ['view' => 'contact_view::contact.shop.index'])
    		->name('shop.contact.index');
    
    Route::post('/contact', 'RKREZA\Contact\Http\Controllers\ContactController@sendMessage')
    		->defaults('_config',['redirect' => 'shop.contact.index'])
    		->name('shop.contact.send-message');

});