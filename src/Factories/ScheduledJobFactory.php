<?php

namespace Stepanenko3\NovaCards\Factories;

use App\Console\Kernel;
use Illuminate\Support\Arr;
use Illuminate\Console\Parser;
use Carbon\Carbon;
use Cron\CronExpression;
use ReflectionClass;
use Stepanenko3\NovaCards\Vendor\CronSchedule;

class ScheduledJobFactory
{
    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function __get($name)
    {
        return $this->event->{$name};
    }

    public function command()
    {
        if ($this->event instanceof \Illuminate\Console\Scheduling\CallbackEvent) {
            return $this->event->description ?? 'Closure';
        }

        preg_match('/artisan.*?\\s(.*)/', $this->event->command, $matches);

        return $matches[1] ?? null;
    }

    public function className()
    {
        if ($this->event instanceof \Illuminate\Console\Scheduling\CallbackEvent) {
            return $this->event->description;
        }

        [$command] = Parser::parse($this->command());

        // $commands = app(Kernel::class)->all();

        // if (!isset($commands[$command])) {
        //     return '';
        // }

        // return get_class($commands[$command]);

        return '';
    }

    public function description()
    {
        try {
            $reflection = new ReflectionClass($this->className());

            return (string) Arr::get($reflection->getDefaultProperties(), 'description', '');
        } catch (\ReflectionException $exception) {
            return '';
        }
    }

    public function humanReadableExpression()
    {
        return CronSchedule::fromCronString($this->event->expression)->asNaturalLanguage();
    }

    public function timezone()
    {
        return $this->event->timezone ?: 'UTC';
    }

    public function nextRunAt($expression = null, $tz = null)
    {
        if (!$expression) {
            $expression = $this->event->expression;
        }
        if (!$tz) {
            $tz = $this->timezone();
        }

        $cron = new CronExpression($expression);
        $nextRun = Carbon::instance($cron->getNextRunDate());

        if ($tz) {
            $nextRun->setTimezone($tz);
        }

        return $nextRun;
    }
}
