<?php

use App\Http\Controllers\AcuerdoController;
use App\Http\Controllers\PlanformativoController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/acuerdo/{record}', [AcuerdoController::class, 'acuerdo'])->name('acuerdo');
Route::get('/planformativo/{record}', [PlanformativoController::class, 'planformativo'])->name('planformativo');


