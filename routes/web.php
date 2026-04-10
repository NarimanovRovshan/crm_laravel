<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');

//Показать форму создания
Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');

//Обработать отправку формы
Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');