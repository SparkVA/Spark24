<?php

Route::get('/discord/oauth', [\Modules\Spark24\Http\Controllers\Frontend\DiscordController::class, 'login']);
Route::get('/discord/unlink', [\Modules\Spark24\Http\Controllers\Frontend\DiscordController::class, 'unlink']);

/*
 * To register a route that needs to be authentication, wrap it in a
 * Route::group() with the auth middleware
 */
// Route::group(['middleware' => 'auth'], function() {
//     Route::get('/', 'IndexController@index');
// })
