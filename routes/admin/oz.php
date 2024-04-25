<?php
Route::group(['prefix' => 'oz', 'namespace' => 'Admin', 'as' => 'oz_'], function () {
    //Post code
    Route::group(['key' => 'Settings', 'prefix' => 'postcode', 'as' => 'postcode_'], function () {
        Route::get('/manage', ['uses' => 'PostcodeController@index', 'title' => 'Manage Postcode', 'show' => 'Yes', 'position' => 'Top'])->name('index');
        Route::post('/store', ['uses' => 'PostcodeController@storeUpdate'])->name('store');
        Route::get('/edit/{id}', ['uses' => 'PostcodeController@index'])->name('edit');
        Route::get('/update', ['uses' => 'PostcodeController@storeUpdate'])->name('update');
        Route::delete('/destroy/{id}', ['uses' => 'PostcodeController@destroy'])->name('destroy');
    }); // End post code

    // coupons/category management routes
    Route::group(['key' => 'Settings', 'prefix' => 'coupon', 'as' => 'coupon_'], function () {
        Route::get('/manage', ['uses' => 'CouponController@index', 'title' => 'Manage Coupon', 'show' => 'Yes', 'position' => 'Top'])->name('index');
        Route::post('store', ['uses' => 'CouponController@store'])->name('store');
        Route::get('edit/{id}', ['uses' => 'CouponController@index'])->name('edit');
        Route::post('update', ['uses' => 'CouponController@storeUpdate'])->name('update');
        Route::delete('/destroy/{id}', ['uses' => 'CouponController@destroy'])->name('destroy');
        //Route::get('coupon_status/{id}/{action}', ['as' => 'coupon_status', 'uses' => '\App\Http\Controllers\Admin\CouponController@coupon_status'])->name('coupon_status');
        //Route::get('check_coupon_avaiable', ['as' => 'check_coupon_avaiable', 'uses' => '\App\Http\Controllers\Admin\CouponController@check_coupon_avaiable'])->name('check_coupon_avaiable');
    }); // End coupon


    // schedule manager/schedule manager routes
    Route::group(['key' => 'Settings', 'prefix' => 'schedule', 'as' => 'schedule_'], function () {
        Route::get('manage', ['uses' => 'ScheduleManagerController@index', 'title' => 'Manage Schedule', 'show' => 'Yes', 'position' => 'Top'])->name('index');
        Route::post('store', ['uses' => 'ScheduleManagerController@store'])->name('store');
        Route::get('edit/{id}', ['uses' => 'ScheduleManagerController@edit_schedule'])->name('edit');
        Route::post('update', ['uses' => 'ScheduleManagerController@schedule_update_save'])->name('update');
        Route::delete('delete/{id}', ['uses' => 'ScheduleManagerController@destroy'])->name('destroy');
        Route::post('batch-delete', ['uses' => 'ScheduleManagerController@btchDestroy'])->name('batch_destroy');

        Route::get('schedule_generator', ['uses' => 'ScheduleManagerController@schedule_generator'])->name('generator');
        Route::post('save_schedules', ['uses' => 'ScheduleManagerController@save_schedules'])->name('save');
    }); // End coupon

    // Order manager routes
    Route::group(['key' => 'Order', 'prefix' => 'order', 'as' => 'order_'], function () {
        Route::get('manage', ['uses' => 'BookingController@adminOrders', 'title' => 'Manage Order', 'show' => 'Yes', 'position' => 'Left'])->name('index');
//        Route::get('manage', ['uses' => 'BookingController@adminOrders', 'title' => 'Manage Order', 'show' => 'Yes', 'position' => 'Left'])->name('index');

        Route::get('/api/get', ['uses' => 'BookingController@getApiOrder'])->name('api_get');
        Route::delete('/destroy/{id}', ['uses' => 'BookingController@destroy', 'title' => 'Delete Order'])->name('destroy');
        Route::get('/order/edit', ['uses' => function(){
            return true;
        }, 'title' => 'View User Order'])->name('view_order');
        Route::post('service_item_by_admin', ['uses' => 'BookingController@add_service_item_by_admin',])->name('add_service_item_by_admin');
        Route::get('/add_service_item_order', ['uses' => function(){
            return true;
        },  'title' => 'Add Additional Service'])->name('add_service_item_order');
    });
});
