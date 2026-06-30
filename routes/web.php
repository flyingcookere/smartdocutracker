<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentLogController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DocumentLogController::class, 'nudgeDocument'])->name('dashboard')->middleware(['auth', 'verified']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get(uri:'readQR', action: function () {
        return view('readQR');
    })->middleware(['auth', 'verified'])->name('readQR');
    
    Route::get('/document/search',function () {
        return view('document.search');
    })->middleware(['auth', 'verified'])->name('document.search');
    
    
    Route::post('/document/store', [DocumentController::class, 'store'])->name('document.store');
    Route::post('/document/search', [DocumentLogController::class, 'showLogFromSearch'])->name('document.search.submit')->middleware(['auth', 'verified']);
    Route::delete('/document/{uuid}/delete', [DocumentController::class, 'deleteEntry'])->name('document.deleteEntry');
    Route::get('/document/create', [DocumentController::class, 'create'])->name('document.create');
    Route::get('/document/myDocs', [DocumentController::class, 'showUserDocs'])->name('document.myDocs');
    Route::get('/document/{uuid}', [DocumentController::class, 'show'])->name('document.show');
    
    
    Route::post('/document/{uuid}/update-status', [DocumentLogController::class, 'updateStatus'])->name('document.updateStatus');
    Route::get('/document/{uuid}/status', [DocumentLogController::class, 'view'])->name('document.view');
    Route::get('/document/{uuid}/logs', [DocumentLogController::class, 'showLogsEdit'])->name('document.logs');
});


require __DIR__.'/auth.php';
