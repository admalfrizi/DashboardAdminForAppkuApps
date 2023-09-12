<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasCategoryController;
use App\Http\Controllers\KelasImagesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsImagesController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\WebinarImagesController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/',[DashboardController::class, 'index']);
        
        Route::get('webinar', [WebinarController::class, 'index'])->name("webinar.index");
        Route::get('kelas', [KelasController::class, 'index'])->name("kelas.index");
        Route::get('categoryKelas', [KelasCategoryController::class, 'index'])->name("categoryKelas.index");
        Route::get('news', [NewsController::class, 'index'])->name("news.index");

        Route::get('webinar/create', [WebinarController::class, 'create'])->name("webinar.create");
        Route::get('categoryKelas/create', [KelasCategoryController::class, 'create'])->name("categoryKelas.create");
        Route::get('kelas/create', [KelasController::class, 'create'])->name("kelas.create");
        Route::get('news/create', [NewsController::class, 'toCreate'])->name("news.create");

        Route::get('news/edit/{id}', [NewsController::class, 'edit'])->name("news.edit");
        Route::get('kelas/edit/{id}', [KelasController::class, 'edit'])->name("kelas.edit");
        Route::get('webinar/edit/{id}', [WebinarController::class, 'edit'])->name("webinar.edit");
        Route::get('categoryKelas/edit/{id}',[KelasCategoryController::class, 'edit'])->name("categoryKelas.edit");

        Route::post('kelas/store', [KelasController::class, 'store'])->name("kelas.store");
        Route::post('news/store', [NewsController::class, 'store'])->name("news.store");
        Route::post('categoryKelas/store', [NewsController::class, 'store'])->name("categoryKelas.store");
        Route::post('webinar/store', [WebinarController::class, 'store'])->name("webinar.store");

        Route::post('categoryKelas/update/{id}', [KelasCategoryController::class, 'update'])->name("categoryKelas.update");
        Route::post('kelas/update', [KelasController::class, 'update'])->name("kelas.update");
        Route::post('news/update/{id}', [NewsController::class, 'update'])->name("news.update");
        Route::post('webinar/update/{id}', [WebinarController::class, 'update'])->name("webinar.update");

        Route::get('kelas/delete/{id}', [KelasController::class, 'delete'])->name("kelas.delete");
        Route::get('webinar/delete/{id}', [WebinarController::class, 'delete'])->name("webinar.delete");
        Route::get('categoryKelas/delete/{id}', [KelasCategoryController::class, 'delete'])->name("categoryKelas.delete");
        Route::get('news/delete/{id}', [NewsController::class, 'delete'])->name("news.delete");

        Route::get('webinar/{id}/webinarGallery', [WebinarImagesController::class, 'index'])->name("webinar.webinarGallery.index");
        Route::get('webinar/{id}/webinarGallery/create',[WebinarImagesController::class, 'create'])->name('webinar.webinarGallery.create');
        Route::post('webinar/{id}/webinarGallery/store',[WebinarImagesController::class, 'store'])->name('webinar.webinarGallery.store');
        Route::get('webinar/{webinarId}/webinarGallery/delete/{id}', [WebinarImagesController::class, 'delete'])->name("webinar.webinarGallery.delete");

        Route::get('kelas/{id}/kelasGallery',[KelasImagesController::class, 'index'])->name('kelas.kelasGallery.index');
        Route::get('kelas/{id}/kelasGallery/create',[KelasImagesController::class, 'create'])->name('kelas.kelasGallery.create');
        Route::post('kelas/{id}/kelasGallery/store',[KelasImagesController::class, 'store'])->name('kelas.kelasGallery.store');
        Route::get('kelas/{id}/kelasGallery/delete/{kelasId}',[KelasImagesController::class, 'delete'])->name('kelas.kelasGallery.delete');

        Route::get('news/{id}/newsGallery',[NewsImagesController::class, 'index'])->name('news.newsGallery.index');
        Route::get('news/{id}/newsGallery/create',[NewsImagesController::class, 'create'])->name('news.newsGallery.create');
        Route::post('news/{id}/newsGallery/store',[NewsImagesController::class, 'store'])->name('news.newsGallery.store');
        Route::get('news/{id}/newsGallery/delete/{newsId}',[NewsImagesController::class, 'delete'])->name('news.newsGallery.delete');

    });
});
