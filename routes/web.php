<?php

use App\Models\Language;
use Illuminate\Support\Facades\Route;

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

Route::view('/','mobile.home');

//Route::get('/', \App\Http\Controllers\FetchDataController::class);

Route::get('/m', function () {
//    return \App\Models\Category::first()->title['ar'];
    return \App\Models\Category::where('title.fa', 'like', '%علوم آن%')->get();
});

