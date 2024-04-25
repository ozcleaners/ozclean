/**
    * Route Property Custom
    * key => Group Name
    * title => Route Custom Title //If title Property Present , Its upload to DB
    * show => is it show in any menu (Value: Yes, No)
    * position =>  (Value: Left, Right, Top, Bottom)
*/

Route::group(['key' => 'Warehouse','prefix' => 'warehouse', 'as' => 'warehouse_'], function(){
    Route::get('/manage', ['uses'=>'WarehouseController@index', 'title' => 'Manage Warehouse'])->name('index');
    Route::get('/create', ['uses'=>'WarehouseController@create', 'title' => 'Add'])->name('create');
    Route::post('/store', 'WarehouseController@store')->name('store');
    Route::get('/edit/{id}', ['uses' => 'WarehouseController@edit', 'title' => 'Edit'])->name('edit');
    Route::post('/update', 'WarehouseController@update')->name('update');
    Route::delete('/delete/{id}', ['uses'=>'WarehouseController@destroy', 'title' => 'Delete'])->name('destroy');
});
