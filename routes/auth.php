<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\AuthFormController;
use App\Http\Controllers\ReviewsController;

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/logout', [AuthFormController::class, 'logout'])->name('logout');
    Route::get('/reviews/{product}', [ReviewsController::class, 'view'])->name('reviewsView');
    Route::get('/verify-email/{token}', [EmailController::class, 'verify'])->name('verification.verify');

    Route::match (['post', 'get'], '/profile/update/{type}', [ProfileController::class, 'update'])->name('update');

    Route::post('/password/update', [PasswordController::class, 'passwordUpdate'])->name('passwordUpdate');
    Route::post('/reviews/add', [ReviewsController::class, 'addReview'])->name('reviewsAdd');
    Route::post('/send/verify-email', [EmailController::class, 'Sendverify'])->name('verification.verifyEmailSend');
});

Route::middleware('guest')->group(function () {

    Route::get('/form', [AuthFormController::class, 'form'])->name('form');
    Route::get('/login', [AuthFormController::class, 'formLogin'])->name('login');
    Route::get('/register', [AuthFormController::class, 'formRegister'])->name('register');

    Route::post('/user/login', [AuthFormController::class, 'userlogin'])->name('user.login');
    Route::post('/user/register', [AuthFormController::class, 'userregister'])->name('user.register');

});
