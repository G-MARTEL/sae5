<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupervisionController;

//Route::get('/', function () {return view('supervision');});



Route::get('/', [SupervisionController::class, 'showSupervision']);
