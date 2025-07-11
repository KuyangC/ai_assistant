<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;

Route::get('/', function () {
    return view('app');
});

Route::get('/task', function () {
    return view('task');
});

Route::get('/reminder', [ReminderController::class, 'index'])->name('reminders.index');
Route::post('/reminder', [ReminderController::class, 'store'])->name('reminders.store');

Route::get('/finance', function () {
    return view('finance');
});

Route::get('/note', function () {
    return view('note');
});

Route::get('/recomendation', function () {
    return view('recomendation');
});

Route::get('/journal', function () {
    return view('journal');
});

Route::get('/chat', function () {
    return view('chat');
});

