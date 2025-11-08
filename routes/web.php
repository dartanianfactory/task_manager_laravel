<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\WebPagesController;

Route::controller(WebPagesController::class)->group(function() {
    Route::get('/', 'home')->name('common.pages.home');
});
