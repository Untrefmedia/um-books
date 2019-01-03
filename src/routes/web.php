<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin', 'auth:admin']], function () {
    Route::resource('venue', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController');
    Route::get('venue.dataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController@dataList')->name('venue.dataList');

    Route::resource('book', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController');
    Route::get('book.dataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@dataList')->name('book.dataList');

    Route::resource('event', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController');
    Route::get('event.dataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController@dataList')->name('event.dataList');
});
