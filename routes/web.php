<?php

use App\Http\Controllers\AbalosCountController;
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
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AbalosDashboardController;
use App\Http\Controllers\AbalosUserController;
use App\Http\Controllers\AbalosController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
Route::post('/submit', [AbalosController::class, 'handleReCaptcha'])->name('submit');

Route::get('/abalos-users', [AbalosUserController::class, 'index'])->name('abalos-users.index');
Route::post('/abalos-users', [AbalosUserController::class, 'store'])->name('abalos-users.store');
Route::get('/abalos-users/{id}/edit', [AbalosUserController::class, 'edit'])->name('abalos-users.edit');
Route::put('/abalos-users/{id}', [AbalosUserController::class, 'update'])->name('abalos-users.update');
Route::delete('/abalos-users/{id}', [AbalosUserController::class, 'destroy'])->name('abalos-users.destroy');
Route::resource('abalos-users', AbalosUserController::class);

use App\Http\Controllers\AbalosCategoryController;

// Resourceful routes for categories
Route::get('/abalos-categories', [AbalosCategoryController::class, 'index'])->name('abalos-categories.index');
Route::post('/abalos-categories', [AbalosCategoryController::class, 'store'])->name('abalos-categories.store');
Route::get('/abalos-categories/{id}/edit', [AbalosCategoryController::class, 'edit'])->name('abalos-categories.edit');
Route::put('/abalos-categories/{id}', [AbalosCategoryController::class, 'update'])->name('abalos-categories.update');
Route::delete('/abalos-categories/{id}', [AbalosCategoryController::class, 'destroy'])->name('abalos-categories.destroy');
Route::resource('abalos-categories', AbalosCategoryController::class);

use App\Http\Controllers\AbalosProductController;

// Route for displaying the product index
// Routes for Abalos Products
Route::get('/abalos-products', [AbalosProductController::class, 'index'])->name('abalos-products.index');
Route::post('/abalos-products', [AbalosProductController::class, 'store'])->name('abalos-products.store');
Route::get('/abalos-products/create', [AbalosProductController::class, 'create'])->name('abalos-products.create');
Route::get('/abalos-products/{id}/edit', [AbalosProductController::class, 'edit'])->name('abalos-products.edit');
Route::put('/abalos-products/{id}', [AbalosProductController::class, 'update'])->name('abalos-products.update');
Route::delete('/abalos-products/{id}', [AbalosProductController::class, 'destroy'])->name('abalos-products.destroy');
Route::resource('abalos-products', AbalosProductController::class);

use App\Http\Controllers\AbalosChartController;

Route::get('/abalos/chart', [AbalosChartController::class, 'index'])->name('abalos.chart');







 // Example for admin access


Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('/otp', [AuthController::class, 'showOtpForm'])->name('otp.verify');
Route::post('/otp', [AuthController::class, 'verifyOtp'])->name('otp.verify.post');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login/otp', [AuthController::class, 'showLoginOtpForm'])->name('otp.login.verify');
Route::post('/login/otp', [AuthController::class, 'verifyLoginOtp']);
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Protected route with authentication and role middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
// routes/web.php

Route::middleware('auth')->group(function () {
    // User Dashboard
    Route::get('user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // Admin Dashboard
    Route::middleware('role:admin')->group(function () {
        Route::get('admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('admin/dashboard', [AbalosDashboardController::class, 'index'])->name('admin.dashboard');
    });
});

Route::get('password/forgot', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');
// routes/web.php
use App\Http\Controllers\AbalosProfileController;

Route::middleware('auth')->group(function () {
    Route::post('/profile/update', [AbalosProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/deactivate', [AbalosProfileController::class, 'deactivate'])->name('profile.deactivate');
});
use App\Http\Controllers\AbalosEditPostController;

Route::resource('manage', AbalosEditPostController::class);

use App\Http\Controllers\AbalosAddPostController;

Route::get('/posts/create', [AbalosAddPostController::class, 'create'])->name('posts.create');
Route::post('/posts', [AbalosAddPostController::class, 'store'])->name('posts.store');
Route::get('/posts', [AbalosAddPostController::class, 'index'])->name('posts.index');
Route::post('/posts/{post}/comments', [AbalosAddPostController::class, 'addComment'])->name('posts.comments.store');

use App\Http\Controllers\AbalosManagePController;

Route::get('/home', [AbalosManagePController::class, 'home'])->name('posts.home');
Route::patch('/posts/{id}/update-status', [AbalosManagePController::class, 'updateStatus'])->name('posts.updateStatus');

Route::get('/dashboard', [AbalosProfileController::class, 'dashboard'])->name('user.dashboard');
 

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


