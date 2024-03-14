<?php

use Illuminate\Support\Facades\Route;
use Stepanenko3\NovaCards\Http\Controllers\BlockchainExchangeController;
use Stepanenko3\NovaCards\Http\Controllers\CacheController;
use Stepanenko3\NovaCards\Http\Controllers\EnvironmentController;
use Stepanenko3\NovaCards\Http\Controllers\NovaInstalledVersionController;
use Stepanenko3\NovaCards\Http\Controllers\NovaReleasesController;
use Stepanenko3\NovaCards\Http\Controllers\ScheduledJobsController;
use Stepanenko3\NovaCards\Http\Controllers\SslController;
use Stepanenko3\NovaCards\Http\Controllers\SystemResourcesController;
use Stepanenko3\NovaCards\Http\Controllers\VersionsController;
use Stepanenko3\NovaCards\Http\Controllers\WeatherController;
use Stepanenko3\NovaCards\Http\Controllers\WorldClockController;

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
Route::get('ssl', SslController::class);
Route::get('world-clock', WorldClockController::class);
Route::get('blockchain-exchange', BlockchainExchangeController::class);
Route::get('environment', EnvironmentController::class);
Route::controller(CacheController::class)
    ->prefix('cache')
    ->group(function (): void {
        Route::post('flush', 'flush');
        Route::get('load', 'load');
        Route::post('', 'forget');
        Route::get('', 'get');
    });

Route::get('weather', WeatherController::class);
Route::get('nova-releases', NovaReleasesController::class);
Route::get('nova-version', NovaInstalledVersionController::class);
