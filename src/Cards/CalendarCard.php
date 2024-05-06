<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class CalendarCard extends Card
{
    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $now = now();

        $this->withMeta([
            'day' => [
                'name' => $now->dayName,
                'shortName' => $now->minDayName,
                'number' => $now->day,
                'withMonth' => $now->isoFormat('Do MMMM'),
            ],
            'month' => [
                'name' => $now->monthName,
                'name2' => $now->getTranslatedMonthName('Do MMMM'),
                'shortName' => $now->shortMonthName,
                'number' => $now->month,
                'withDay' => $now->isoFormat('Do MMMM'),
            ],
            'year' => $now->year,
            'dayOfWeek' => $now->dayOfWeek,
            'dayOfYear' => $now->dayOfYear,
            'weekOfMonth' => $now->weekOfMonth,
            'weekOfYear' => $now->weekOfYear,
            'daysInMonth' => $now->daysInMonth,
            'quarter' => $now->quarter,
            'timestamp' => $now->timestamp,
            'timezone' => $now->timezoneName,
        ]);
    }

    public function component(): string
    {
        return 'calendar-card';
    }
}
