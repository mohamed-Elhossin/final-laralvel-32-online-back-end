<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;



Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::prefix('admins')->name("admin.")->group(function () {

    Route::get("/index", [AdminController::class, 'index'])->name("index");
    Route::get("/create", [AdminController::class, 'create'])->name("create");
    Route::get("/show/{id}", [AdminController::class, 'show'])->name("show");

    Route::post("/store", [AdminController::class, 'store'])->name("store");

    Route::get("/edit/{id}", [AdminController::class, 'edit'])->name("edit");
    Route::post("/update/{id}", [AdminController::class, 'update'])->name("update");
    Route::get("/destroy/{id}", [AdminController::class, 'destroy'])->name("destroy");
});



Route::middleware('auth')->group(function () {
    Route::post("change_image/{id}",[ProfileController::class,'change_image'])->name('profile.change_image');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
