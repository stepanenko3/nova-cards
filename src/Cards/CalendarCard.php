<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

/**
 * A simple embedding widget card to allow the integration of an url
 * or <iframe>...</iframe> context on e.g. a dashboard.
 */
class CalendarCard extends Card
{
    /**
     * @param $component
     */
    public function __construct($component = null)
    {
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

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'calendar-card';
    }
}
