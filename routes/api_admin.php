<?php

use App\Http\Controllers\Api\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::match(['get'], '/user',                                  [UserController::class, 'Read'] );
Route::match(['get'], '/users',                                 [UserController::class, 'List'] );
Route::match(['post'], '/user/add',                             [UserController::class, 'Add'] );
Route::match(['get'], '/home',                                  [UserController::class, 'Read'] );

