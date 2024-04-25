<?php
/** Role */
Route::group(['key' => 'Role', 'prefix' => 'role', 'as' => 'role_'], function () {
    Route::get('/manage', ['uses' => 'RoleController@index', 'title' => 'Manage Roles', 'show' => 'Yes', 'position' => 'Left'])->name('index');
    Route::get('/create', ['uses' => 'RoleController@create', 'title' => 'Add', 'show' => 'Yes', 'position' => 'Left'])->name('create');
    Route::post('/store', 'RoleController@store')->name('store');
    Route::get('/edit/{id}', ['uses' => 'RoleController@edit', 'title' => 'Edit'])->name('edit');
    Route::post('/update', 'RoleController@update')->name('update');
    Route::delete('/delete/{id}', ['uses' => 'RoleController@destroy', 'title' => 'Delete'])->name('destroy');
});
