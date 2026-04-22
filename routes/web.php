<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function() {
    return redirect('/student');
});

Route::get('/student', [StudentController::class, 'index'])
    ->name('student.index');

Route::get('/student/add', [StudentController::class, 'create'])
    ->name('student.create');

Route::post('/student/add', [StudentController::class, 'store'])
    ->name('student.store'); 

Route::get('/student/edit/{id}', [StudentController::class, 'edit'])
    ->name('student.edit');

Route::put('/student/{id}', [StudentController::class, 'update'])
    ->name('student.update');

Route::delete('/student/{id}', [StudentController::class, 'destroy'])
    ->name('student.destroy');

Route::get('/student/{id}', [StudentController::class, 'show'])
    ->name('student.show');