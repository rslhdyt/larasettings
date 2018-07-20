<?php

Route::group(['middleware' => config('settings.middleware')], function () {
    Route::get('settings', 'Rslhdyt\LaraSettings\Controllers\SettingController@edit')->name('settings.edit');
    Route::put('settings', 'Rslhdyt\LaraSettings\Controllers\SettingController@update')->name('settings.update');
});
