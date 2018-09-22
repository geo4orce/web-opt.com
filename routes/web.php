<?php

Route::get('/', 'MasterController@index')
    ->name('home');

Route::get('ru', 'MasterController@ru')
    ->name('ru-home');

Route::get('amp', 'AmpController@index')
    ->name('home-amp');

Route::get('ru/amp', 'AmpController@ru')
    ->name('ru-home-amp');
