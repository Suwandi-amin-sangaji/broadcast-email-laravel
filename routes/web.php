<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/import-tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::post('/import-tickets', [TicketController::class, 'import'])->name('tickets.import');

Route::get('/broadcast-emails', [TicketController::class, 'broadcastEmails'])->name('tickets.broadcast');
Route::delete('/tickets/delete-multiple', [TicketController::class, 'deleteMultiple'])->name('tickets.deleteMultiple');


Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');
