<?php

use App\Http\Controllers\Admin\CMS\LayoutController;
use App\Http\Controllers\Admin\CMS\MenuController;
use App\Http\Controllers\Admin\CMS\PageController;
use App\Http\Controllers\Admin\CMS\TemplateController;
use App\Http\Controllers\Admin\CRM\ContactController;
use App\Http\Controllers\Admin\CRM\FormController;
use App\Http\Controllers\Admin\CRM\FormSubmissionController;
use App\Http\Controllers\Admin\FileManagerController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::group([
    'as' => 'profile.',
    'prefix' => 'profile'
], function() {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
    Route::put('/', [ProfileController::class, 'update'])->name('update');
});

Route::resource('users', UserController::class);

Route::group([
    'as' => 'git.',
    'prefix' => 'git'
], function() {
    Route::resource('repositories', \App\Http\Controllers\Admin\Git\RepositoryController::class)->only(['index', 'show', 'edit', 'update']);
});

/** Fallback admin route - ensures Auth() calls work as expected in the exception handler */
Route::fallback(function () {
    abort(404);
});
