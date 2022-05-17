<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;
use Stepanenko3\NovaCards\Traits\PollingTrait;

class WorldClockCard extends Card
{
    use PollingTrait;

    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Create a new element.
     * @param  string|null  $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->initPolling();
        $this->withMeta([
            'timeFormat' => 'H:i:s',
        ]);
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
            'timezones' => $timezones
        ]);
    }

    public function timeFormat($timeFormat)
    {
        return $this->withMeta([
            'timeFormat' => $timeFormat
        ]);
    }

    public function title($title = '')
    {
        return $this->withMeta([
            'title' => $title
        ]);
    }
}
