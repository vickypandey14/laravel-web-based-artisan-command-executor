<?php

use App\Http\Controllers\CommandRunnerController;
use Illuminate\Support\Facades\Route;


Route::controller(CommandRunnerController::class)->group(function () 
{    
    Route::get('/command-runner', 'index')->name('command-runner.index');
    Route::post('/command-runner/run', 'run')->name('command-runner.run');
});
