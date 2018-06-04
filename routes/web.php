<?php

Route::get('/', 'MasterController@index');
Route::get('ru', 'MasterController@ru');
Route::get('amp', 'AmpController@index');
Route::get('amp/ru', 'AmpController@ru');
