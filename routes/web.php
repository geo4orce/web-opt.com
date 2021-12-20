<?php

Route::get('/', 'MasterController@index')
    ->middleware('cache.headers:public;max_age=3600;etag')
    ->name('home');
