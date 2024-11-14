<?php

use Illuminate\Http\Request;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiatController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware(['auth:sanctum'])->group(function () { //grouping untuk middleware autentikasi wajib login
//     Route::get('/logout', [AuthenticationController::class, 'logout']);
//     Route::get('/user-details', [AuthenticationController::class, 'detailUser']);
//     Route::post('/posts', [PostController::class, 'store']);
//     Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('author-post');
//     Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('author-post');
// });
// Route::get('/posts', [PostController::class, 'index']); //menampilkan semua
// Route::get('/posts/{id}', [PostController::class, 'show']); //menampilkan berita berdasarkan id
// Route::post('/login', [AuthenticationController::class, 'login']);


Route::post('/users/login', [UserController::class, 'login']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/logout', [UserController::class, 'logout']);
    Route::post('/users', [UserController::class, 'store']);
    Route::patch('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/giat', [GiatController::class, 'index']);
    Route::get('/giat/{id}', [GiatController::class, 'show']);
    Route::post('/giat', [GiatController::class, 'store']);
    Route::patch('/giat/{id}', [GiatController::class, 'update']);
    Route::delete('/giat/{id}', [GiatController::class, 'destroy']);
// });

Route::get('/penugasan', [PenugasanController::class, 'index']);
Route::get('/penugasan/{id}', [PenugasanController::class, 'show']);
Route::patch('/penugasan/{id}', [PenugasanController::class, 'update']);
Route::delete('/penugasan/{id}', [PenugasanController::class, 'destroy']);

Route::get('/items', [ItemController::class, 'index']);
