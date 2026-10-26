<?php

use App\Models\Contest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home', [
        'contests' => Contest::query()->with('station')->orderBy('ends_at')->get(),
    ]);
});
