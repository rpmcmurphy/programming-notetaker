<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\DownloadsController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Cats
Route::get('/cats', [CatController::class, 'index'])->name('cats.index');
Route::get('/cats/create', [CatController::class, 'create'])->name('cats.create');
Route::post('/cats', [CatController::class, 'store'])->name('cats.store');
Route::get('/cats/{id}', [CatController::class, 'show'])->name('cats.show');
Route::get('/cats/{id}/edit', [CatController::class, 'edit'])->name('cats.edit');
Route::post('/cats/{id}', [CatController::class, 'update'])->name('cats.update');
Route::post('/cats/destroy/{id}', [CatController::class, 'destroy'])->name('cats.destroy');

// Tags
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
Route::get('/tags/{id}', [TagController::class, 'show'])->name('tags.show');
Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
Route::post('/tags/{id}', [TagController::class, 'update'])->name('tags.update');
Route::post('/tags/destroy/{id}', [TagController::class, 'destroy'])->name('tags.destroy');

// Details 
Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
Route::get('/notes/{id}', [NoteController::class, 'show'])->name('notes.show');
Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::post('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
Route::post('/notes/destroy/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');
Route::post('/notes-delete-file', [NoteController::class, 'delete_file'])->name('notes.delete_file');

Route::get('/search', [NoteController::class, 'search'])->name('search');
Route::post('/search', [NoteController::class, 'search_result'])->name('search.result');

Route::get('/download/{file_path}', [DownloadsController::class, 'download'])->name('download');