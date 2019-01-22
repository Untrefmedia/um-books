<?php

Route::group(['prefix' => 'admin'], function () {
    // Guardar datos del formulario público
    Route::resource('book', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController')->only(['store']);
    Route::post('availabilityBook', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@availabilityBook');
    Route::post('datesNotAvailability', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@datesNotAvailability');
    
    // Admin
    Route::group(['middleware' => ['web', 'admin', 'auth:admin']], function () {
        Route::resource('venue', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController');
        Route::get('venueDataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController@dataList')->name('venue.dataList');

        Route::resource('book', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController')->except(['store']);
        Route::get('bookDataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@dataList')->name('book.dataList');

        Route::resource('event', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController');
        Route::get('eventDataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController@dataList')->name('event.dataList');
    });
});

// Formulario público
Route::get('bookForm', 'Untrefmedia\UMBooks\App\Http\Controllers\BookController@form')->name('book.form');
