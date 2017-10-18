<?php

Route::group(['middleware' => 'web', 'prefix' => 'classified', 'namespace' => 'Modules\Classified\Http\Controllers'], function()
{
    Route::get('/', 'ClassifiedController@index');
});
