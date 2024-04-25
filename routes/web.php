<?php

use Illuminate\Support\Facades\Route;
include 'sitemap.php';


Route::get('email', function(){
   return view('email.order_confirmed');
});

include 'frontend.php';


Auth::routes();

include 'admin.php';
