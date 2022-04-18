<?php

namespace Stepanenko3\NovaCards\Cards;

use Carbon\Carbon;
use Laravel\Nova\Card;

class CountdownCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Set the label at the bottom of the timer.
     *
     * @param  string  $label
     * @return self
     */
    public function label(string $label)
    {
        return $this->withMeta([
            'label' => $label,
        ]);
    }

    public function title($title = '')
    {
        return $this->withMeta([
            'title' => $title
        ]);
    }

    /**
     * Set the end date of the countdown.
     *
     * @param  \Carbon\Carbon  $date
     * @return self
     */
    public function to(Carbon $date)
    {
        return $this->withMeta([
            'to' => $date->timestamp * 1000
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'countdown-card';
    }
}
