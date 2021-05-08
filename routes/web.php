<?php

// use App\Http\Controllers\DepartmentController;
// use App\Http\Controllers\DishController;
// use App\Http\Controllers\ImageController;
// use App\Http\Controllers\LoginController;
// use App\Http\Controllers\StaffController;
// use App\Http\Controllers\TableController;
// use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::prefix('api')->group(function () {
//     Route::get('image/{thuMuc}/{hinhAnh}', [ImageController::class, 'get']);
//     Route::post('login', [LoginController::class, 'login']);
//     Route::middleware('auth:sanctum')->group(function () {
//         Route::post('logout', [LoginController::class, 'logout']);
//         Route::post('user', [LoginController::class, 'user']);
//         Route::resource('staff', StaffController::class);
//         Route::get('department/get', [DepartmentController::class, 'get']);
//         Route::resource('department', DepartmentController::class);
//         Route::resource('table', TableController::class);
//         Route::resource('type', TypeController::class);
//         Route::resource('dish', DishController::class);
//     });
// });

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
