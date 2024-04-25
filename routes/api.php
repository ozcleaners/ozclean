<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Admin API
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'postcode', 'as' => 'api_admin_'], function () {
    Route::get('check-postcode-service/{postcode}/{service_id}', ['uses' => 'PostcodeController@checkPostService'])->name('check_postcode_service');
});
