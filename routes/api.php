<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Api\ApiBuzCard;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
Route::delete('user/{id}', [ApiBuzCard::class, 'deleteUser']);
Route::get('users', [ApiBuzCard::class, 'getAllUsers'])->name('api.users');

Route::get('user/{id}', [ApiBuzCard::class, 'getUser']);
Route::post('users', [ApiBuzCard::class, 'createUser']);
Route::put('user/{id}', [ApiBuzCard::class, 'updateUser']);
