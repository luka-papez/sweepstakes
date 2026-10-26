<?php

use App\Http\Controllers\Api\ContestController;
use App\Http\Controllers\Api\EntryController;
use Illuminate\Support\Facades\Route;

Route::get('/contests', [ContestController::class, 'index']);
Route::get('/contests/{contest}', [ContestController::class, 'show']);
Route::post('/contests/{contest}/entries', [EntryController::class, 'store']);
