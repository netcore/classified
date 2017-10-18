<?php

Route::group([
    'prefix'     => 'admin/classified',
    'as'         => 'admin::classified.',
    'middleware' => ['web', 'auth.admin'],
    'namespace'  => 'Modules\Classified\Http\Controllers\Admin'
], function () {
    Route::resource('fields', 'FieldController');
});
