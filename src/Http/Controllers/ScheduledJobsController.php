<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Cron\CronExpression;
use DateTimeZone;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;

class ScheduledJobsController extends Controller
{
    public function __invoke(
        Kernel $kernel,
        Schedule $schedule,
    ) {
        $timezone = new DateTimeZone(config('app.timezone'));

        $jobs = collect($schedule->events())
            ->map(function ($event) use ($timezone) {
                $nextDueDate = $this->getNextDueDateForEvent(
                    event: $event,
                    timezone: $timezone,
                );

                preg_match('/artisan.*?\\s(.*)/', $event->command, $matches);

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

        // $scheduler = app(\Illuminate\Console\Scheduling\Schedule::class);
        // $events = $scheduler->events();

        // foreach ($events as $event) {
        //     preg_match('/artisan.*?\\s(.*)/', $event->command, $matches);
        //     $command = $matches[1] ?? null; // Extract the command if available

        //     $nextDueDate = $event->nextRunDate();
        //     $timezone = $event->timezone ?: config('app.timezone');

        //     $this->info(json_encode([
        //         'command' => $command,
        //         'description' => $event->description,
        //         'expression' => $event->expression,
        //         'humanReadableExpression' => $nextDueDate->diffForHumans(),
        //         'nextRunAt' => $nextDueDate->toIso8601String(),
        //         'humanReadableNextRun' => $nextDueDate->diffForHumans(),
        //         'timezone' => $timezone,
        //         'withoutOverlapping' => $event->withoutOverlapping,
        //         'onOneServer' => $event->onOneServer,
        //     ]));
        // }

        return response()->json($jobs);
    }

    private function getNextDueDateForEvent(
        Event $event,
        DateTimeZone $timezone
    ): Carbon {
        return Carbon::instance(
            date: (new CronExpression($event->expression))
                ->getNextRunDate(
                    currentTime: Carbon::now()
                        ->setTimezone($event->timezone),
                )
                ->setTimezone($timezone)
        );
    }
}
