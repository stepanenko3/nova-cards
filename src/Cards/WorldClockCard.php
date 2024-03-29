<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class WorldClockCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Create a new element.
     *
     * @param null|string $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'world-clock-card';
    }

    public function timezones($timezones)
    {
        return $this->withMeta([
            'timezones' => $timezones,
        ]);
    }

    public function title($title = '')
    {
        return $this->withMeta([
            'title' => $title,
        ]);
    }
}
