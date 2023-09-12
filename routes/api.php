<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserDataController;
use App\Http\Controllers\API\KelasCategoryController;
use App\Http\Controllers\API\WebinarDataController;
use App\Http\Controllers\API\KelasDataController;
use App\Http\Controllers\API\NewsDataController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login',[AuthController::class, 'login']);

Route::post('kelasCategory', [KelasCategoryController::class, 'index']);
Route::post('kelasCategory/create', [KelasCategoryController::class, 'storeData']);
Route::post('kelasCategory/{id}', [KelasCategoryController::class, 'updateData']);

Route::post('webinar', [WebinarDataController::class, 'index']);
Route::post('webinar/create', [WebinarDataController::class, 'storeData']);
Route::post('webinar/{id}', [WebinarDataController::class, 'updateData']);

Route::post('news',[NewsDataController::class, 'index']);
Route::post('kelas', [KelasDataController::class, 'index']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('profile', function(Request $request) {
        return auth()->user();
    });

    Route::post('/logout',[AuthController::class, 'logout']);


    Route::post('/updateData/{id}',[UserDataController::class, 'update']);
});
