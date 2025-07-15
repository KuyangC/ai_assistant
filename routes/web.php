<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NoteController;

Route::get('/', function () {
    return view('app');
});

Route::get('/task', [TaskController::class, 'index'])->name('tasks.index');
Route::post('/task', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/task/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::put('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');


Route::get('/reminder', [ReminderController::class, 'index'])->name('reminders.index');
Route::post('/reminder', [ReminderController::class, 'store'])->name('reminders.store');

Route::get('/finance', [TransactionController::class, 'index'])->name('transactions.index');
Route::post('/finance', [TransactionController::class, 'store'])->name('transactions.store');
Route::delete('/finance/{id}', [TransactionController::class, 'destroy'])->name('transactions.destroy');

Route::get('/note', [NoteController::class, 'index'])->name('notes.index');
Route::post('/note', [NoteController::class, 'store'])->name('notes.store');
Route::get('/note/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
Route::put('/note/{id}', [NoteController::class, 'update'])->name('notes.update');
Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');

Route::get('/recomendation', function () {
    return view('recomendation');
});

Route::get('/chat', function () {
    return view('chat');
});

