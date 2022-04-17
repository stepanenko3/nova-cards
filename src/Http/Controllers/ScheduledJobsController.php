<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Routing\Controller;
use Stepanenko3\NovaCards\Factories\ScheduledJobFactory;

class ScheduledJobsController extends Controller
{
    public function __invoke(Kernel $kernel, Schedule $schedule)
    {
        $jobs = collect($schedule->events())
            ->map(function ($event) {

                $scheduleEvent = new ScheduledJobFactory($event);

                return [
                    'command' => $scheduleEvent->command(),
                    'description' => $scheduleEvent->description(),
                    'expression' => $scheduleEvent->expression,
                    'humanReadableExpression' => $scheduleEvent->humanReadableExpression(),
                    'nextRunAt' => $scheduleEvent->nextRunAt()->toIso8601String(),
                    'humanReadableNextRun' => $scheduleEvent->nextRunAt()->diffForHumans(),
                    'timezone' => $scheduleEvent->timezone(),
                    'withoutOverlapping' => $scheduleEvent->withoutOverlapping,
                    'onOneServer' => $scheduleEvent->onOneServer,
                    'evenInMaintenanceMode' => $scheduleEvent->evenInMaintenanceMode,
                ];
            });

        return response()->json($jobs);
    }
}
