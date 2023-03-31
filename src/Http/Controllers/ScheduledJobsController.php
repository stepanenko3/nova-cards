<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Cron\CronExpression;
use DateTimeZone;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;

class ScheduledJobsController extends Controller
{
    public function __invoke(Kernel $kernel, Schedule $schedule)
    {
        $timezone = new DateTimeZone(config('app.timezone'));

        $jobs = collect($schedule->events())
            ->map(function ($event) use ($timezone) {
                $nextDueDate = $this->getNextDueDateForEvent($event, $timezone);

                preg_match("/artisan.*?\s(.*)/", $event->command, $matches);

                $command = $matches[1] ?? null;

                return [
                    'command' => $command,
                    'description' => $event->description,
                    'expression' => $event->expression,
                    'humanReadableExpression' => $nextDueDate->diffForHumans(),
                    'nextRunAt' => $nextDueDate->toIso8601String(),
                    'humanReadableNextRun' => $nextDueDate->diffForHumans(),
                    'timezone' => $timezone,
                    'withoutOverlapping' => $event->withoutOverlapping,
                    'onOneServer' => $event->onOneServer,
                ];
            });

        return response()->json($jobs);
    }

    /**
     * Get the next due date for an event.
     *
     * @param  \Illuminate\Console\Scheduling\Event  $event
     * @param  \DateTimeZone  $timezone
     * @return \Illuminate\Support\Carbon
     */
    private function getNextDueDateForEvent($event, DateTimeZone $timezone)
    {
        return Carbon::instance(
            (new CronExpression($event->expression))
                ->getNextRunDate(Carbon::now()->setTimezone($event->timezone))
                ->setTimezone($timezone)
        );
    }
}
