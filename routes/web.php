<?php

use App\Http\Controllers\AcuerdoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/acuerdo/{record}', [AcuerdoController::class, 'acuerdo'])->name('acuerdo');

