<?php 

    Route::prefix('install')->namespace('DGvai\Larataller\LaraController')->middleware(['web','install'])->group(function(){
        Route::get('/','InstallerController@begin')->name('installer.require');
        Route::get('/app-data','InstallerController@appdata')->name('installer.appdata');
        Route::get('/database','InstallerController@database')->name('installer.database');
        Route::get('/migration','InstallerController@migration')->name('installer.migration');
        Route::get('/uploaddb','InstallerController@uploaddb')->name('installer.uploaddb');
        Route::get('/extra','InstallerController@extra')->name('installer.extra');

        Route::post('/app-data', 'InstallerController@saveAppdata')->name('installer.appdata.save');
        Route::post('/database', 'InstallerController@saveDatabase')->name('installer.database.save');
        Route::post('/extra', 'InstallerController@saveExtra')->name('installer.extra.save');
    });