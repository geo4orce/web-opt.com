<?php

Route::get('/', 'MasterController@index')
    ->middleware('cache.headers:private;max_age=3600')
    ->name('home');
