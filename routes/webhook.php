<?php

use Illuminate\Support\Facades\Route;

// Website Routes
Route::group([
    'as'        => 'webhook.',
], function() {
    Route::post('github', function () {
        return response([
            'message' => 'Success'
        ]);
    })->name('github');
});
