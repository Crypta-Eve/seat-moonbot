<?php

Route::group([
    'namespace' => 'CryptaEve\Seat\MoonBot\Http\Controllers',
    'middleware' => ['web', 'auth'],
    'prefix' => 'moonbot'
], function () {
    
    Route::get('/configure', [
        'as'   => 'moonbot.configure',
        'uses' => 'MoonBotController@getConfigureView',
        'middleware' => 'can:moonbot.edit'
    ]);

    Route::post('/postapinew', [
        'as'   => 'moonbot.createApi',
        'uses' => 'MoonBotController@postNewApi',
        'middleware' => 'can:moonbot.edit'
    ]);

    Route::get('/delapibyid/{id}', [
        'as'   => 'moonbot.deleteApi',
        'uses' => 'MoonBotController@deleteApiById',
        'middleware' => 'can:squadsync.edit'
    ]);

    Route::get('/about', [
        'as'   => 'moonbot.about',
        'uses' => 'MoonBotController@getAboutView',
        'middleware' => 'can:moonbot.edit'
    ]);
    
});


Route::group([
    'namespace' => 'CryptaEve\Seat\MoonBot\Http\Controllers',
    // 'middleware' => ['web', 'auth'],
    'prefix' => 'moonbot/public'
], function () {
    Route::get('/{slug}', [
        'as'   => 'moonbot.public',
        'uses' => 'MoonBotController@getPublicData'
    ]);

    Route::get('/update/{slug}', [
        'as'   => 'moonbot.public',
        'uses' => 'MoonBotController@processUpdateApi'
    ]);
});
