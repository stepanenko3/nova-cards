<?php

use Illuminate\Support\Facades\Route;
use Stepanenko3\NovaCards\Http\Controllers\PercentageController;
use Stepanenko3\NovaCards\Http\Controllers\ScheduledJobsController;
use Stepanenko3\NovaCards\Http\Controllers\SystemResourcesController;
use Stepanenko3\NovaCards\Http\Controllers\VersionsController;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/

Route::get('system-resources', SystemResourcesController::class);
Route::get('versions', VersionsController::class);
Route::get('scheduled-jobs', ScheduledJobsController::class);
