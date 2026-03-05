<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\LibraryController;
Route::get('/', function () {
return redirect('/admin');
});
Route::prefix('library')->group(function () {
Route::get('/', [LibraryController::class, 'index'])->name('library.index');
Route::get('/book/{id}', [LibraryController::class, 'bookDetail'])->name('library.book');
Route::get('/category/{slug}', [LibraryController::class, 'category'])->name('library.category');
Route::get('/search', [LibraryController::class, 'search'])->name('library.search');
});
