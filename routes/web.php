<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableviewController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::get('/tableview',[TableviewController::class,'index'])->name('generate.tableview.index.post');
     Route::post('/tableview',[TableviewController::class,'store'])->name('generate.tableview.index.post'); 
     Route::get('/tableview/{id}/edit',[TableviewController::class,'edit'])->name('tableview.edit');
     Route::put('/tableview/{id}',[TableviewController::class,'update'])->name('tableview.update');
     Route::get('/tableview/{id}', [TableviewController::class, 'destroy'])->name('tableview.destroy');

});

require __DIR__.'/auth.php';
Route::get('{original_url}',[TableviewController::class,'shortLink'])->name('tableview.index');
