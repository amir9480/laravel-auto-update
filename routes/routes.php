<?php

Route::namespace('\LaravelAutoUpdate\Controllers')->prefix('_laravel-auto-update')->middleware(config('laravelautoupdate.middlewares'))->group(function () {
    Route::get('check', 'UpdateController@check');
    Route::get('updater/download', 'UpdateController@download');
    Route::get('updater/extract', 'UpdateController@extract');
    Route::get('updater/move', 'UpdateController@move');
    Route::get('updater.js', 'UpdateController@js');
});
