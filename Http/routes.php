<?php

Route::group([
    'prefix'     => 'admin/classified',
    'as'         => 'admin::classified.',
    'middleware' => ['web', 'auth.admin'],
    'namespace'  => 'Modules\Classified\Http\Controllers\Admin'
], function () {
    Route::resource('parameters', 'ParameterController');

    Route::delete('/parameters/destroy-attribute/{attribute}', [
        'uses' => 'ParameterController@destroyAttribute',
        'as'   => 'parameters.destroy-attribute'
    ]);

    Route::put('/parameters/update-attributes/{attribute}', [
        'uses' => 'ParameterController@updateAttribute',
        'as'   => 'parameters.update-attributes'
    ]);

    Route::post('/parameters/{parameter}/store-attribute', [
        'uses' => 'ParameterController@storeAttribute',
        'as'   => 'parameters.store-attributes'
    ]);
});
