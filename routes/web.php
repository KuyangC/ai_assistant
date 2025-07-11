<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('app');
});

Route::get('/task', function () {
    return view('task');
});

Route::get('/reminder', [ReminderController::class, 'index'])->name('reminders.index');
Route::post('/reminder', [ReminderController::class, 'store'])->name('reminders.store');

Route::get('/finance', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/finance', [TransactionController::class, 'store'])->name('transactions.store');
Route::delete('/finance/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

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

