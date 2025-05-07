<?php

use App\Http\Controllers\CommandRunnerController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(CommandRunnerController::class)->group(function () 
{    
    Route::get('/command-runner', 'indexCommandRunner')->name('command-runner.index');
    Route::post('/command-runner/run', 'runCommandRunner')->name('command-runner.run');
    Route::post('/command-runner/clear-history', 'clearHistory')->name('command-runner.clear-history');
    
});
