<?php

Route::get('/', function () {
    return view('index');
})->middleware('require_auth');

Route::get('/signup', function () {
    return view('signup');
});

Route::group(['middleware' => ['user_check']], function () {
    Route::get('/home', function () {
        return view('home');
    });
    Route::prefix('products')->group(function () {
        Route::get('/logout', 'Products\ProductController@logout');
        Route::get('/list_products', 'Products\ProductController@listproducts');
        Route::post('/newproduct', 'Products\ProductController@newproduct');
        Route::post('/updateproduct', 'Products\ProductController@updateproduct');
        Route::post('/deleteproduct', 'Products\ProductController@deleteproduct');
    });
});

Route::prefix('products')->group(function () {
    Route::post('/login', 'Products\MainController@index');
    Route::post('/signup', 'Products\MainController@signup');
});
