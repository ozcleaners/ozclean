<?php

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/404', ['uses' => 'App\Http\Controllers\HomeController@error404'])->name('404');
Route::get('/upload/routelist', [App\Http\Controllers\HomeController::class, 'uploadRoutes'])->name('upload_routelist');

Route::group([
    'prefix' => 'admin',
    'middleware' => array('auth', 'user'),
    'namespace' => 'App\Http\Controllers',
], function () {

    /**
     * Route Propertty Custom
     * key => Group Name
     * title => Route Custom Title
     * show => is it show in any menu (Value: Yes, No)
     * position =>  (Value: Left, Right, Top, Bottom)
     * show_for => Which Show Menu After Request Url
     */

    Route::get('testview', 'TestController@index');


    Route::group(['key' => 'Dashboard', 'as' => 'admin_'], function () {
        Route::get('dashboard', ['uses' => 'HomeController@dashboard', 'title' => 'User Dashboard'])->name('dashboard');
    });

    Route::group(['prefix' => 'superadmin'], function () {
        require_once 'admin/routelist.php';
        require_once 'admin/user.php';
        require_once 'admin/superadmin.php';
        require_once 'admin/attribute.php';
        require_once 'admin/calculator_setting.php';
        require_once 'admin/oz.php';
    });

    require_once 'admin/common.php';

    /** Warehouse  */
    /*
    Route::group(['key' => 'Warehouse', 'prefix' => 'warehouse', 'as' => 'warehouse_'], function () {
        Route::get('/manage', ['uses' => 'WarehouseController@index', 'title' => 'Manage Warehouse'])->name('index');
        Route::get('/create', ['uses' => 'WarehouseController@create', 'title' => 'Add'])->name('create');
        Route::post('/store', 'WarehouseController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'WarehouseController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'WarehouseController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'WarehouseController@destroy', 'title' => 'Delete'])->name('destroy');
        Route::get('/{wh_code}', ['uses' => 'Warehouse\SingleWarehouseController@index', 'title' => 'View Warehouse'])->name('single_index');

    });
*/

    /** Single Warehouse */
    /*
    Route::group(['prefix' => '{wh_code}', 'namespace' => 'Warehouse', 'show_for' => 'Warehouse'], function () {

        //product
        Route::group(['key' => 'Product', 'prefix' => 'product', 'as' => 'product_'], function () {
            Route::get('/manage', ['uses' => 'ProductController@index', 'title' => 'Manage Products'])->name('index');
        });//End Product
    });
*/
});
