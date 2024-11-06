<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::get('/',[NoteController::class,'index'])->name('note.index');
Route::get('/create',[NoteController::class,'create'])->name('note.create');

Route::post('/note',[NoteController::class,'store'])->name('note.store');

Route::get('/note/{note}/edit',[NoteController::class,'edit'])->name('note.edit');

Route::put('/note/{note}/update',[NoteController::class,'update'])->name('note.update');

Route::delete('/note/{id}', [NoteController::class, 'destroy'])->name('note.destroy');