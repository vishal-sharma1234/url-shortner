<?php

use App\Http\Controllers\admin\CompanyController;
use App\Http\Controllers\admin\UrlController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('auth.index');
    Route::get('/companies-dashboard', [UserController::class, 'companies'])->name('companies.index');
    Route::get('/urls-dashboard', [UserController::class, 'urls'])->name('urls.index');
    Route::get('/members-dashboard', [UserController::class, 'members'])->name('members.index');
    Route::any('/generate-url', [UrlController::class, 'index'])->name('generate.url');
    Route::any('/invite-company', [CompanyController::class, 'index'])->name('invite.company');
    Route::any('/invite-member', [UserController::class, 'inviteUser'])->name('invite.member');
});

require __DIR__ . '/auth.php';

Route::any('/s/{url}', [UrlController::class, 'hitUrl']);
