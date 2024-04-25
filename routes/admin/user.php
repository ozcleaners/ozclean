<?php
/** User */

Route::group(['key' => 'User', 'prefix' => 'user', 'as' => 'user_'], function(){
    Route::get('/manage', ['uses'=>'UserController@index', 'title' => 'Manage Users', 'show' => 'Yes', 'position' => 'Left'])->name('index');
    Route::get('/create', ['uses'=>'UserController@create', 'title' => 'Add', 'show' => 'Yes', 'position' => 'Left'])->name('create');
    Route::post('/store', 'UserController@store')->name('store');
    Route::get('/edit/{id}', ['uses' => 'UserController@edit', 'title' =>'Edit'])->name('edit');
    Route::post('/update', 'UserController@update')->name('update');
    Route::post('/change-password', 'UserController@changePassword')->name('change_password');
    Route::delete('/delete/{id}', ['uses'=>'UserController@destroy', 'title' => 'Delete'])->name('destroy');


    //Api
    Route::get('/api/getuser', 'UserController@apiGetUser')->name('api_getuser');
});

?>
