<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

Route::get('/task', function () {
    return view('task');
});

Route::get('/reminder', function () {
    return view('reminder');
});

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
