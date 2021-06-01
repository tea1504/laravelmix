<?php

use App\Http\Controllers\BaoCaoController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TypeController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', [LoginController::class, 'login']);
Route::get('image/{thuMuc}/{hinhAnh}', [ImageController::class, 'get']);
Route::middleware('auth:sanctum')->group(function () {
  Route::post('logout', [LoginController::class, 'logout']);
  Route::post('user', [LoginController::class, 'user']);
  Route::resource('staff', StaffController::class);
  Route::get('department/get', [DepartmentController::class, 'get']);
  Route::resource('department', DepartmentController::class);
  Route::get('table/getbantrong', [TableController::class, 'getBanTrong']);
  Route::get('table/getbanphucvu', [TableController::class, 'getBanPhucVu']);
  Route::get('table/getban', [TableController::class, 'getBan']);
  Route::resource('table', TableController::class);
  Route::get('type/detail', [TypeController::class, 'getDetail']);
  Route::resource('type', TypeController::class);
  Route::resource('dish', DishController::class);
  Route::get('invoice/detail/{id}', [InvoiceController::class, 'detail']);
  Route::post('invoice/thanhtoan/{id}', [InvoiceController::class, 'thanhtoan']);
  Route::resource('invoice', InvoiceController::class);
  Route::get('moncho', [OtherController::class,'MonCho']);
  Route::post('dachebien/{id}', [OtherController::class,'daCheBien']);
  Route::get('lenmon', [OtherController::class, 'lenMon']);
  Route::post('dalen/{id}', [OtherController::class, 'daLen']);
  Route::get('demmoncho', [OtherController::class, 'demMonCho']);
  Route::post('baocao/doanhthutheonam', [BaoCaoController::class, 'DoanhThuTheoNam']);
  Route::post('baocao/doanhthutheothang', [BaoCaoController::class, 'DoanhThuTheoThang']);
});
