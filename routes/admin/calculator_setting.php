<?php
Route::group(['prefix' => 'calculator', 'namespace' => 'Admin', 'as' => 'calculator_'], function () {
    Route::group(['key' => 'Setting', 'prefix' => 'setting', 'as' => 'setting_'], function () {
        Route::get('/manage/{id}', ['uses' => 'CalculatorSettingController@index', 'title' => 'Manage Calculator Setting'])->name('index');
        Route::get('/create', ['uses' => 'CalculatorSettingController@create', 'title' => 'Add'])->name('create');
        Route::post('/store', 'CalculatorSettingController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'CalculatorSettingController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'CalculatorSettingController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'CalculatorSettingController@destroy', 'title' => 'Delete'])->name('destroy');

        Route::post('/list_sorting', 'CalculatorSettingController@list_sorting')->name('list_sorting');
    });

    Route::group(['key' => 'Service Setting', 'prefix' => 'service_setting', 'as' => 'service_setting_'], function () {
        Route::get('/manage/{id}', ['uses' => 'CalcServiceSettingController@index', 'title' => 'Manage Calculator Service Setting'])->name('index');
        Route::get('/create', ['uses' => 'CalcServiceSettingController@create', 'title' => 'Add'])->name('create');
        Route::post('/store', 'CalcServiceSettingController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'CalcServiceSettingController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'CalcServiceSettingController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'CalcServiceSettingController@destroy', 'title' => 'Delete'])->name('destroy');

        Route::post('/list_sorting', 'CalcServiceSettingController@list_sorting')->name('list_sorting');
    });


    Route::group(['key' => 'material Setting', 'prefix' => 'material_setting', 'as' => 'material_setting_'], function () {
        Route::get('/manage/{id}', ['uses' => 'CalcMaterialController@index', 'title' => 'Manage Calculator Material Setting'])->name('index');
        Route::get('/create', ['uses' => 'CalcMaterialController@create', 'title' => 'Add'])->name('create');
        Route::post('/store', 'CalcMaterialController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'CalcMaterialController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'CalcMaterialController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'CalcMaterialController@destroy', 'title' => 'Delete'])->name('destroy');

        Route::post('/list_sorting', 'CalcMaterialController@list_sorting')->name('list_sorting');
    });

    Route::group(['key' => 'Input Type Setting', 'prefix' => 'input_setting', 'as' => 'input_setting_'], function () {
        Route::post('/store', 'CalcInputTypeController@store')->name('store');
        Route::post('/update', 'CalcInputTypeController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'CalcInputTypeController@destroy', 'title' => 'Delete'])->name('destroy');
    });
});
?>
