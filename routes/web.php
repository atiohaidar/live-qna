<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\TodoList;
use App\Livewire\Login;

Route::get('/', \App\Livewire\Landing::class);

Route::get('/todo', TodoList::class);
Route::get('/e/{slug}', \App\Livewire\Public\EventPage::class)->name('event.show');


// Authentication
Route::get('/login', Login::class)->name('login');
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// Admin Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/admin/events', \App\Livewire\Admin\EventList::class)->name('admin.events');
    Route::get('/admin/events/{event}', \App\Livewire\Admin\EventDashboard::class)->name('admin.dashboard');
});
