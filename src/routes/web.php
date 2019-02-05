<?php

Route::group(['prefix' => 'admin'], function () {
    // Guardar datos del formulario público
    Route::resource('book', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController')->only(['store']);

    Route::post('availabilityBook', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@availabilityBook');
    Route::post('datesNotAvailability', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@datesNotAvailability');
    Route::post('getEvents', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@getEvents');
    Route::post('checkCapacityTurn', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@checkCapacityTurn');
    
    // Admin
    Route::group(['middleware' => ['web', 'admin', 'auth:admin']], function () {
        Route::resource('venue', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController');
        Route::get('venueDataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController@dataList')->name('venue.dataList');
        // editar administardores de un venue
        Route::get('venueAdmin/{venue_id}', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController@venueAdmin')->name('venueAdmin.edit');
        Route::post('updateVenueAdmin/{venue_id}', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\VenueController@updateVenueAdmin')->name('venueAdmin.update');
        
        Route::resource('book', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController')->except(['store']);
        Route::get('bookDataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@dataList')->name('book.dataList');
        Route::post('cancelBook', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\BookController@cancelbook');
        Route::post('emailBook', 'Untrefmedia\UMBooks\App\Http\Controllers\EmailController@SendMailBook')->name('email.book');

        Route::resource('event', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController');
        Route::get('eventDataList', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController@dataList')->name('event.dataList');
        Route::get('eventDateBlocked', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController@eventDateBlocked');
        Route::post('eventDateBlocked', 'Untrefmedia\UMBooks\App\Http\Controllers\Admin\EventController@eventDateBlocked')->name('event.dateBlocked.store');
    });
});

// Formulario público
Route::get('bookForm', 'Untrefmedia\UMBooks\App\Http\Controllers\BookController@form')->name('book.form');

