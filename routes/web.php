<?php

use App\Http\Livewire\BuzCard;
use App\Http\Livewire\BuzProfile;
use App\Http\Livewire\CardImage;
use App\Http\Livewire\GenerateBuzCard;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/generate', GenerateBuzCard::class)->name('generate');

Route::get('/livewire/card-image/{id}', CardImage::class)->name('card-image');

Route::get('/livewire/buz-card/{id}', BuzCard::class)->name('buz-card');
    
Route::get('{user_name}', BuzProfile::class)->name('buz-profile');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');
});