<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/today');

Route::get('today', [\App\Http\Controllers\Mobile\V1\HomeController::class, 'today'])->name('mobile.today');
Route::get('all', [\App\Http\Controllers\Mobile\V1\HomeController::class, 'all'])->name('mobile.all');
Route::get('categories', [\App\Http\Controllers\Mobile\V1\HomeController::class, 'all'])->name('mobile.categories');
Route::get('favorites', [\App\Http\Controllers\Mobile\V1\HomeController::class, 'all'])->name('mobile.favorites');
Route::get('search', [\App\Http\Controllers\Mobile\V1\HomeController::class, 'all'])->name('mobile.search');
Route::get('login', [\App\Http\Controllers\Mobile\V1\HomeController::class, 'all'])->name('mobile.login');

Route::get('generate', \App\Http\Controllers\FetchDataController::class);

Route::get('/m', function () {
    //    return \App\Models\Category::first()->title['ar'];
    return \App\Models\Category::where('title.fa', 'like', '%علوم آن%')->get();
});
