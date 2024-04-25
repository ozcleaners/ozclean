<?php
/** User */

Route::group(['prefix' => 'common', 'namespace' => 'Admin', 'as' => 'common_'], function () {
    Route::group(['key' => 'Page', 'prefix' => 'page', 'as' => 'page_'], function () {
        Route::get('/manage', ['uses' => 'PageController@index', 'title' => 'Manage Pages', 'show' => 'Yes', 'position' => 'Left'])->name('index');
        Route::get('/create', ['uses' => 'PageController@create', 'title' => 'Add', 'show' => 'Yes', 'position' => 'Left'])->name('create');
        Route::post('/store', 'PageController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'PageController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'PageController@update')->name('update');
        Route::any('/grapes_update', 'PageController@grapes_update')->name('grapes_update');
        Route::any('/grapes_load_now', 'PageController@grapes_load_now')->name('grapes_load_now');
        Route::delete('/delete/{id}', ['uses' => 'PageController@destroy', 'title' => 'Delete'])->name('destroy');
        Route::get('/api/get', ['uses' => 'PageController@apiGet'])->name('api_get');
    });

    Route::group(['key' => 'Term', 'prefix' => 'term', 'as' => 'term_'], function () {
        Route::get('/manage', ['uses' => 'TermController@index', 'title' => 'Manage Terms', 'show' => 'Yes', 'position' => 'Left'])->name('index');
        Route::get('/create', ['uses' => 'TermController@create'])->name('create');
        Route::post('/store', 'TermController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'TermController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'TermController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'TermController@destroy', 'title' => 'Term Delete'])->name('destroy');
        Route::any('/grapes_update', 'TermController@grapes_update')->name('grapes_update');
        Route::any('/grapes_load_now', 'TermController@grapes_load_now')->name('grapes_load_now');

        // Custom Field for section
        Route::post('/custom_field_store', ['uses'=> 'TermCustomFieldController@custom_field_store', 'title' => 'Add new Section in Zone '])->name('custom_field_store');
        Route::get('/custom_field_edit/{id}', ['uses' => 'TermCustomFieldController@edit',  'title' => 'Term Zone'])->name('custom_field_edit');
        Route::post('/custom_field_update', 'TermCustomFieldController@update')->name('custom_field_update');
        Route::delete('/custom_field_delete/{id}', ['uses' => 'TermCustomFieldController@destroy', 'title' => 'Delete Section in Zone'])->name('custom_field_destroy');

        Route::get('/custom_field_seo/{id}', ['uses' => 'SeoInformationController@seo_information', 'title' => 'Zone Seo'])->name('custom_field_seo');
        Route::post('/custom_field_seo_store', 'SeoInformationController@custom_field_seo_store')->name('custom_field_seo_store');
        Route::get('/custom_field_seo_edit/{id}', ['uses' => 'SeoInformationController@custom_field_seo_edit'])->name('custom_field_seo_edit');
        Route::post('/custom_field_seo_update', 'SeoInformationController@custom_field_seo_update')->name('custom_field_seo_update');

        Route::post('/custom_field_sorting', 'TermCustomFieldController@sorting')->name('custom_fields_sorting');
        Route::get('/copy_content_form/{id}', 'TermCustomFieldController@copy_content_form')->name('copy_content_form');
        Route::post('/copy_content', 'TermCustomFieldController@copy_content')->name('copy_content');
        Route::post('/copy_zone_content', ['uses' => 'TermCustomFieldController@copy_zone_content', 'title' => 'Zone Content Copy'])->name('copy_zone_content');
        Route::get('/zone_other_setting/{id}', 'TermCustomFieldController@zone_other_setting')->name('zone_other_setting');
        Route::post('/zone_other_setting_store', 'TermCustomFieldController@zone_other_setting_store')->name('zone_other_setting_store');

        // Post code rate
        Route::get('{id}/postcode-rate', 'TermCustomFieldController@postcode_rate')->name('postcode_rate');
        Route::post('{id}/postcode-rate-storeUpdate', 'TermCustomFieldController@postcode_rate_store_update')->name('postcode_rate_store_update');
        Route::delete('{id}/postcode-rate/delete', 'TermCustomFieldController@postcode_rate_delete')->name('postcode_rate_destroy');
        // Custom Field Breakdown of a section
        Route::get('/custom_field_breakdown_add/{id}', ['uses' => 'TermCustomFieldController@breakdown_add_form'])->name('custom_field_breakdown_add');
        //Route::get('/edit/{id}/which_editor=term_custom_field/custom_field_edit/{custom_field_id}/breakdown', ['uses' => 'TermCustomFieldController@breakdown_add_form'])->name('custom_field_breakdown_add');
        Route::post('/custom_field_breakdown_store', 'TermCustomFieldController@custom_field_breakdown_store')->name('custom_field_breakdown_store');
        Route::get('/custom_field_breakdown_edit/{id}', ['uses' => 'TermCustomFieldController@breakdown_edit'])->name('custom_field_breakdown_edit');
        //Route::get('/edit/{id}/which_editor=term_custom_field/custom_field_edit/{custom_field_id}/breakdown/{custom_field_breakdown_id}', ['uses' => 'TermCustomFieldController@breakdown_edit'])->name('custom_field_breakdown_edit');
        Route::post('/custom_field_breakdown_update', 'TermCustomFieldController@breakdown_update')->name('custom_field_breakdown_update');

        Route::delete('/custom_field_breakdown_delete/{id}', ['uses' => 'TermCustomFieldController@breakdown_destroy', 'title' => 'Custom field Breakdown Delete'])->name('breakdown_destroy');

        Route::post('/custom_field_breakdown_sorting', 'TermCustomFieldController@breakdown_sorting')->name('custom_fields_breakdown_sorting');

        Route::post('/import_postcode', 'TermCustomFieldController@import_postcode')->name('import_postcode');

    });


    Route::group(['key' => 'Post', 'prefix' => 'post', 'as' => 'post_'], function () {
        Route::get('/manage', ['uses' => 'PostController@index', 'title' => 'Manage Posts', 'show' => 'Yes', 'position' => 'Left'])->name('index');
        Route::get('/create', ['uses' => 'PostController@create', 'title' => 'Add', 'show' => 'Yes', 'position' => 'Left'])->name('create');
        Route::post('/store', 'PostController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'PostController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'PostController@update')->name('update');
        Route::any('/grapes_update', 'PostController@grapes_update')->name('grapes_update');
        Route::any('/grapes_load_now', 'PostController@grapes_load_now')->name('grapes_load_now');
        Route::delete('/delete/{id}', ['uses' => 'PostController@destroy', 'title' => 'Delete Post'])->name('destroy');
        Route::get('/api/get', ['uses' => 'PostController@apiGet'])->name('api_get');


        // Custom Field for section
        Route::post('/custom_field_store', 'PostCustomFieldController@custom_field_store')->name('custom_field_store');
        Route::post('/custom_field_store', 'PostCustomFieldController@custom_field_store')->name('custom_field_store');
        Route::get('/custom_field_edit/{id}', ['uses' => 'PostCustomFieldController@edit'])->name('custom_field_edit');
        Route::post('/custom_field_update', 'PostCustomFieldController@update')->name('custom_field_update');
        Route::delete('/custom_field_delete/{id}', ['uses' => 'PostCustomFieldController@destroy', 'title' => 'Delete Custom Field'])->name('custom_field_destroy');


        // Custom Field Breakdown of a section
        Route::get('/custom_field_breakdown_add/{id}', ['uses' => 'PostCustomFieldController@breakdown_add_form'])->name('custom_field_breakdown_add');

        Route::post('/custom_field_breakdown_store', 'PostCustomFieldController@custom_field_breakdown_store')->name('custom_field_breakdown_store');
        Route::get('/custom_field_breakdown_edit/{id}', ['uses' => 'PostCustomFieldController@breakdown_edit'])->name('custom_field_breakdown_edit');

        Route::post('/custom_field_breakdown_update', 'PostCustomFieldController@breakdown_update')->name('custom_field_breakdown_update');

        Route::delete('/custom_field_breakdown_delete/{id}', ['uses' => 'PostCustomFieldController@breakdown_destroy', 'title' => 'Delete Breakdown'])->name('breakdown_destroy');

        Route::post('/custom_field_breakdown_sorting', 'PostCustomFieldController@breakdown_sorting')->name('custom_fields_breakdown_sorting');
    });


    Route::group(['key' => 'Media', 'prefix' => 'media', 'as' => 'media_'], function () {
        Route::get('/manage', ['uses' => 'MediaController@index', 'title' => 'Manage Medias', 'show' => 'Yes', 'position' => 'Left'])->name('index');
        Route::get('/create', ['uses' => 'MediaController@create'])->name('create');
        Route::post('/store', 'MediaController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'MediaController@edit', 'title' => 'Edit'])->name('edit');
        Route::get('/detail/{id}', ['uses' => 'MediaController@detail'])->name('detail');
        Route::post('/update', 'MediaController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'MediaController@destroy', 'title' => 'Delete'])->name('destroy');
        Route::get('/search/{key}', 'MediaController@search')->name('search');
        Route::get('/file/manage', ['uses' => 'MediaController@fileManage', 'title' => 'Manage Files'])->name('file_manage');
        Route::post('/file/store', ['uses' => 'MediaController@fileStore'])->name('file_store');
        Route::delete('/file/delete/{id}', ['uses' => 'MediaController@fileDestroy'])->name('file_destroy');
    });

    Route::group(['key' => 'Settings', 'prefix' => 'setting', 'as' => 'setting_'], function () {
        Route::get('/manage', ['uses' => 'GlobalSettingController@index', 'title' => 'Global Settings', 'show' => 'Yes', 'position' => 'Left'])->name('index');
        Route::get('/create', ['uses' => 'GlobalSettingController@create'])->name('create');
        Route::post('/store', 'GlobalSettingController@store')->name('store');
        Route::get('/edit/{id}', ['uses' => 'GlobalSettingController@edit', 'title' => 'Edit'])->name('edit');
        Route::post('/update', 'GlobalSettingController@update')->name('update');
        Route::delete('/delete/{id}', ['uses' => 'GlobalSettingController@destroy', 'title' => 'Delete'])->name('destroy');


        // Frontend Settings
        Route::get('seetings/fronend/view', ['uses' => 'FrontendSettingsController@index', 'title' => 'Frontend Settings', 'show' => 'Yes', 'position' => 'Left'])->name('frontend_settings_index');
        Route::post('seetings/fronend/store', 'FrontendSettingsController@store')->name('frontend_settings_store');
        Route::post('seetings/fronend/update', 'FrontendSettingsController@update')->name('frontend_settings_update');

        // Frontend Settings Label
    });

    Route::get('menus', ['uses' => 'TermController@menus', 'title' => 'Menus', 'show' => 'Yes', 'position' => 'Left'])->name('menus');


    Route::group(['key' => 'General Gallery', 'prefix' => '', 'as' => ''], function () {

        // Album Pcat Controller
        Route::get('album-pcat', ['uses' => 'AlbumsPcatController@index', 'title' => 'Manage Parent Album', 'show' => 'Yes', 'position' => 'Left'])->name('album_pcat_index');
        Route::post('album-pcat/store', 'AlbumsPcatController@store')->name('album_pcat_store');
        Route::put('album-pact/update/{id}', 'AlbumsPcatController@update')->name('album_pcat_update');
        Route::get('album-pcat/delete/{id}', 'AlbumsPcatController@destroy')->name('album_pcat_delete');

        // Album Controller
        Route::get('album', ['uses' => 'AlbumController@index', 'title' => 'Manage Album', 'show' => 'Yes', 'position' => 'Left'])->name('album_index');
        Route::post('album/store', ['uses' => 'AlbumController@store'])->name('album_store');
        Route::put('album/update/{id}', ['uses' => 'AlbumController@update'])->name('album_update');
        Route::get('album/delete/{id}', ['uses' => 'AlbumController@destroy'])->name('album_delete');

        // Gallery
        Route::get('gallery', ['uses' => 'GalleryController@galleries', 'title' => 'Manage Gallery', 'show' => 'Yes', 'position' => 'Left'])->name('gallery_index');
        Route::post('gallery/store', ['uses' => 'GalleryController@galleryStore'])->name('gallery_store');
        Route::post('gallery/update/{id}', ['uses' => 'GalleryController@galleryUpdate'])->name('gallery_update');
        Route::get('gallery/delete/{id}', ['uses' => 'GalleryController@galleryDelete'])->name('gallery_delete');
        Route::post('/gallery/serialUpdate', 'GalleryController@gallerySerialUpdate')->name('gallery_serialupdate');

    });

    Route::group(['key' => 'Service Gallery', 'prefix' => 'service/', 'as' => 'service_'], function () {
        // Service Gallery
        Route::get('gallery', ['uses' => 'GalleryController@service_galleries', 'title' => 'Manage Gallery', 'show' => 'Yes', 'position' => 'Left'])->name('gallery_index');
    });
});

?>
