<?php

use App\Http\Controllers\Api\Asociacion\AsociacionController;
use App\Http\Controllers\Api\Users\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//return response()->json(['errors' => $validator->errors()], 422);




Route::match(['post'], '/gen_token', [UserController::class, 'GenToken'] );

Route::match(['post'], '/register_asociation', [AsociacionController::class, 'Register'] );

Route::match(['get'], '/demo_mail', [AsociacionController::class, 'SendRegisterMail'] );


// Route::get('/user', function (Request $request) {
//     return 'Primer api consultada';
//});
