<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisionController;

//Route::get('/', function () {return view('supervision');});


//Route::get('/', [SupervisionController::class, 'showSupervision']);

//Route::get('/', [SupervisionController::class, 'getDevices'])->name('getDevices');

//Route::get('/', [SupervisionController::class, 'showSupervision'])->name('supervision');

Route::get('/', [SupervisionController::class, 'showSupervision'])->name('supervision');
Route::get('/devices', [SupervisionController::class, 'getDevices'])->name('getDevices');