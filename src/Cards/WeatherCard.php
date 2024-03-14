<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;
use Stepanenko3\NovaCards\Traits\PollingTrait;

class WeatherCard extends Card
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
     *
     * @param null|string $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->initPolling();
    }

    public function city(string $cityName): self
    {
        return $this->withMeta([
            'city' => $cityName,
        ]);
    }

    public function lang(string $lang): self
    {
        return $this->withMeta([
            'lang' => $lang,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'weather-card';
    }
}
