<?php
Route::group([
    'namespace' => 'App\Http\Controllers\Frontend',
    'as' => 'frontend_'
], function () {
    Route::get('/', ['uses' => 'HomeController@index'])->name('index');
    Route::get('/page/{slug}', ['uses' => 'HomeController@page'])->name('page');
    Route::get('/pro-tips', ['uses' => 'HomeController@blogs'])->name('blogs');
    Route::get('/blogs', ['uses' => 'HomeController@blogs'])->name('blogs');
    Route::get('/pro-tips/{slug}', ['uses' => 'HomeController@blog'])->name('blog');
    Route::get('/blogs/{slug}', ['uses' => 'HomeController@blog'])->name('blog');
    Route::get('user/edit_profile/{id}', ['uses' => 'HomeController@editProfile'])->name('edit_profile');
    Route::post('user/modify_profile/{id}', ['uses' => 'HomeController@modifyProfile'])->name('modify_profile');

    /**Galleries**/
    Route::get('/albums', ['uses' => 'GalleryController@albums'])->name('albums');
    Route::get('/albums/{id}', ['uses' => 'GalleryController@albumPhoto'])->name('album_photos');
    Route::get('/p-albums/{id}', ['uses' => 'GalleryController@parentAlbum'])->name('parent_album_photos');
    Route::get('/page/photos', ['uses' => 'GalleryController@albums'])->name('gallery_photos');
    Route::get('/page/photos/{id}', ['uses' => 'GalleryController@albums'])->name('single_gallery_photo');

    /** Service Gallaries **/
    Route::get('/photo-gallery', ['uses' => 'GalleryController@serviceGallery'])->name('service_albums');
    //Route::get('/photo-gallery/{parent_term}/{parent_sub_term?}', ['uses' => 'GalleryController@parentSeviceGallery'])->name('service_parent_albums');

    /**Contact */
    Route::any('/contact', ['uses' => 'HomeController@contact'])->name('contact');


    /** Zone Wise Service Routes **/
    Route::get('/service/{zone}/{parent_term}/{term_title}', ['uses' => 'ServiceController@service_single'])->name('zone_wise_service_single');
    Route::get('/service/{zone}/{parent_term}', ['uses' => 'ServiceController@service_parent'])->name('zone_wise_service_parent');

    /** Booking Form */
    Route::get('booking_form', function(){
        return redirect()->route('frontend_booking_form');
    });
    Route::get('booking-form', ['uses' => 'BookingController@form'])->name('booking_form');
    Route::post('booking_general_info_store', ['uses' => 'BookingController@general_info_store'])->name('booking_general_info_store');
    Route::post('booking_general_info_popup_store', ['uses' => 'BookingController@popupCalculatorSubmit'])->name('booking_general_info_popup_store');
    Route::get('service_details/{id}', ['uses' => 'BookingController@service_details'])->name('service_details');
    Route::get('service_materials_get/{id}/{term_id}', ['uses' => 'BookingController@service_materials_get'])->name('service_materials_get');
    Route::get('get-booking-schedule-time', ['uses' => 'BookingController@get_booking_schedule'])->name('booking_schedule_time');
    Route::post('booking-order-store', ['uses' => 'BookingController@bookingOrderStore'])->name('booking_order_store');

    /** Stripe */
    //Route::get('checkout', 'BookingController@checkout');
    Route::post('checkout', 'BookingController@checkout')->name('checkout_credit_card');
    Route::get('thank_you', 'BookingController@thank_you')->name('thank_you');
    Route::get('booking-confirmed', 'BookingController@thank_you')->name('booking_confirmed');
    Route::get('quote-request', 'BookingController@quote_request')->name('quote_request');
    Route::get('payment_failed', 'BookingController@payment_failed')->name('payment_failed');

    /** Services Terms */
    Route::get('terms_by_id/{id}', ['uses' => 'BookingController@get_sub_terms'])->name('sub_terms_getter');


    /** User */
    Route::get('user/dashboard', ['uses' => 'BookingController@userDashboard'])->name('user_dashboard');
    Route::get('user/order/{hash_code}', ['uses' => 'BookingController@userOrder'])->name('user_order');
    Route::get('invoice/download/{hash_code}', ['uses' => 'BookingController@downloadPdf'])->name('invoice_download');

});

