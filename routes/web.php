<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Mobile\V1\ContactController;
use App\Http\Controllers\Mobile\V1\HomeController;
use App\Http\Controllers\Mobile\V1\MobileAuthController;
use App\Http\Controllers\UtilsController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/today');

Route::get('today', [HomeController::class, 'today'])->name('mobile.today');
Route::get('all', [HomeController::class, 'all'])->name('mobile.all');
Route::get('about', [HomeController::class, 'about'])->name('mobile.about');
Route::get('contact', [ContactController::class, 'contactView'])->name('mobile.contact');
Route::post('contact', [ContactController::class, 'postContact'])->name('mobile.postContact');
Route::get('categories', [HomeController::class, 'categories'])->name('mobile.categories');
Route::get('hadiths/{hadith}', [HomeController::class, 'showHadith'])->name('mobile.hadiths.show');
Route::post('hadiths/{hadith}/comment', [HomeController::class, 'postComment'])->name('mobile.hadiths.postComment');
Route::get('hadiths/{hadith}/bookmark', [HomeController::class, 'bookmark'])->name('mobile.hadiths.bookmark');
Route::get('categories/{category}/hadiths', [HomeController::class, 'showCategoryHadiths'])->name('mobile.category.hadiths');
Route::get('bookmarks', [HomeController::class, 'bookmarks'])->name('mobile.bookmarks')->middleware('auth:web');
Route::get('profile', [MobileAuthController::class, 'profile'])->name('mobile.profile')->middleware('auth:web');
Route::post('profile', [MobileAuthController::class, 'updateProfile'])->name('mobile.updateProfile')->middleware('auth:web');
Route::get('search', [HomeController::class, 'search'])->name('mobile.search');
Route::post('search', [HomeController::class, 'postSearch'])->name('mobile.postSearch');

Route::get('change-language/{locale}', [UtilsController::class, 'changeLanguage'])->name('change-language');

Route::get('login', [HomeController::class, 'showLogin'])->name('mobile.login');
Route::get('login', [MobileAuthController::class, 'showLogin'])->name('login');
Route::post('login', [MobileAuthController::class, 'postLogin'])->name('postLogin');
Route::get('register', [MobileAuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('register', [MobileAuthController::class, 'postRegister'])->name('postRegister')->middleware('guest');
Route::get('logout', [MobileAuthController::class, 'logout'])->name('logout')->middleware('auth:web');
Route::get('verify-registration-email/{user}/{hash}', [MobileAuthController::class, 'verifyRegistrationEmail'])->name('verifyRegistrationEmail');

//Route::get('generate', \App\Http\Controllers\FetchDataController::class);
//Route::get('reshape', \App\Http\Controllers\ReshapeDataController::class);

//Route::get('/m', function () {
//    //    return \App\Models\Category::first()->title['ar'];
//    return \App\Models\Category::where('title.fa', 'like', '%علوم آن%')->get();
//});

Route::middleware('auth:web')->prefix('dashboard')->as('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::resource('categories', CategoryController::class);
    Route::resource('languages', LanguageController::class);
    Route::resource('users', UserController::class);
});
