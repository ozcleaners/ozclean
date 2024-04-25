<?php 
Route::group(['key' => 'Routelist', 'prefix' => 'routelist', 'as' => 'routelist_'], function(){
    Route::get('/manage', ['uses'=>'RoutelistController@index','title' => 'Manage Route', 'show' => 'Yes', 'position' => 'Left'])->name('index');
    Route::get('/create', ['uses'=>'RoutelistController@create', 'title' => 'Add', 'show' => 'Yes', 'position' => 'Left'])->name('create');
    Route::post('/store', 'RoutelistController@store')->name('store');
    Route::get('/edit/{id}', ['uses'=>'RoutelistController@edit', 'title' => 'Edit'])->name('edit');
    Route::post('/update', 'RoutelistController@update')->name('update');
    Route::delete('/delete/{id}', ['uses'=>'RoutelistController@destroy','title' => 'Delete'])->name('destroy');


    //Api
    Route::get('/api/get', 'RoutelistController@apiGet')->name('api_get');
});