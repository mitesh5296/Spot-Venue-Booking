<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\VenuesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReviewsController;


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
  
Route::get('/', function () {
    return redirect('login');
});
  
Auth::routes();
  
/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('admin.home');
    Route::prefix('categories')->group(function(){
        Route::get('/', [CategoriesController::class, 'list'])->name('categories.list');
        Route::get('/add', [CategoriesController::class, 'add'])->name('categories.add');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::post('/save', [CategoriesController::class, 'save'])->name('categories.save');
        Route::get('/ajaxlist', [CategoriesController::class, 'ajaxList'])->name('categories.ajaxlist');
    });
    Route::prefix('amenities')->group(function(){
        Route::get('/', [AmenitiesController::class, 'list'])->name('amenities.list');
        Route::get('/add', [AmenitiesController::class, 'add'])->name('amenities.add');
        Route::get('/edit/{id}', [AmenitiesController::class, 'edit'])->name('amenities.edit');
        Route::post('/save', [AmenitiesController::class, 'save'])->name('amenities.save');
        Route::get('/ajaxlist', [AmenitiesController::class, 'ajaxList'])->name('amenities.ajaxlist');
    });
    Route::prefix('venues')->group(function(){
        Route::get('/', [VenuesController::class, 'list'])->name('venues.list');
        Route::get('/add', [VenuesController::class, 'add'])->name('venues.add');
        Route::get('/edit/{id}', [VenuesController::class, 'edit'])->name('venues.edit');
        Route::post('/save', [VenuesController::class, 'save'])->name('venues.save');
        Route::get('/ajaxlist', [VenuesController::class, 'ajaxList'])->name('venues.ajaxlist');
    });
    // ========================= User Start here ====================================================
    Route::prefix('users')->group(function(){
        Route::get('/', [UserController::class, 'list'])->name('users.list');
        Route::get('/add', [UserController::class, 'add'])->name('users.add');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
        Route::post('/save', [UserController::class, 'save'])->name('users.save');
        Route::get('/ajaxlist', [UserController::class, 'ajaxList'])->name('users.ajaxlist');
    });
    // ========================= User End here ====================================================

    // ========================= Booking Start here ===============================================
    Route::prefix('bookings')->group(function(){
        Route::get('/', [BookingController::class, 'list'])->name('bookings.list');
        Route::get('/add', [BookingController::class, 'add'])->name('bookings.add');
        Route::get('/edit/{id}', [BookingController::class, 'edit'])->name('bookings.edit');
        Route::post('/save', [BookingController::class, 'save'])->name('bookings.save');
        Route::get('/ajaxlist', [BookingController::class, 'ajaxList'])->name('bookings.ajaxlist');
    });
    // ========================= Booking End here ===============================================
    
    // ========================= Reviews Start here ===============================================
    Route::prefix('reviews')->group(function(){
        Route::get('/', [ReviewsController::class, 'list'])->name('reviews.list');
        Route::get('/add', [ReviewsController::class, 'add'])->name('reviews.add');
        Route::get('/edit/{id}', [ReviewsController::class, 'edit'])->name('reviews.edit');
        Route::post('/save', [ReviewsController::class, 'save'])->name('reviews.save');
        Route::get('/ajaxlist', [ReviewsController::class, 'ajaxList'])->name('reviews.ajaxlist');
    });
    // ========================= Reviews End here ===============================================
    Route::get('/delete/{id}/{module}', [HomeController::class, 'delete'])->name('delete');
});
  
/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:manager'])->prefix('manager')->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('manager.home');
});
