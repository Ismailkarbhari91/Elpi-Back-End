<?php

Route::group(['middleware' => ['web', 'theme', 'locale', 'currency']], function () {

    // all shop routes will be place here

    Route::view('/cms-shop', 'cmspage::shop.index');

    


});
