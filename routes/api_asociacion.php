<?php

use App\Http\Controllers\Api\Asociacion\AsociacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::match(['get'], '/user', [AsociacionController::class, 'Index'] );

