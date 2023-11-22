<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Mobile\V1\HomeController;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/today');

Route::get('today', [HomeController::class, 'today'])->name('mobile.today');
Route::get('all', [HomeController::class, 'all'])->name('mobile.all');
Route::get('categories', [HomeController::class, 'categories'])->name('mobile.categories');
Route::get('hadiths/{hadith}', [HomeController::class, 'showHadith'])->name('mobile.hadiths.show');
Route::get('categories/{category}/hadiths', [HomeController::class, 'showCategoryHadiths'])->name('mobile.category.hadiths');
Route::get('favorites', [HomeController::class, 'all'])->name('mobile.favorites')->middleware('auth:web');
Route::get('search', [HomeController::class, 'search'])->name('mobile.search');
Route::get('login', [HomeController::class, 'all'])->name('mobile.login');
Route::get('login', [HomeController::class, 'all'])->name('login');

Route::get('generate', \App\Http\Controllers\FetchDataController::class);
Route::get('reshape', \App\Http\Controllers\ReshapeDataController::class);

Route::get('/m', function () {
    //    return \App\Models\Category::first()->title['ar'];
    return \App\Models\Category::where('title.fa', 'like', '%علوم آن%')->get();
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::prefix('dashboard')->as('dashboard.')->group(function () {
    Route::resource('categories', CategoryController::class);
});

Route::get('change-language/{locale}', [UtilsController::class, 'changeLanguage'])->name('change-language');
