<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Users;
use App\Livewire\Proprietarios;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', Users::class);
Route::get('/proprietarios', Proprietarios::class);


