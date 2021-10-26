<?php

use App\Http\Controllers\Webhook\GithubWebhookController;
use Illuminate\Support\Facades\Route;

// Website Routes
Route::group([
    'as'        => 'webhook.',
], function() {
    Route::post('github', GithubWebhookController::class)->name('github');
});
