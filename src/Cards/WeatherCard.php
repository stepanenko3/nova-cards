<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;
use Stepanenko3\NovaCards\Traits\PollingTrait;

class WeatherCard extends Card
{
    use PollingTrait;

    public $width = '1/3';

    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->initPolling();
    }

    public function city(
        string $cityName,
    ): self {
        return $this->withMeta([
            'city' => $cityName,
        ]);
    }

    public function lang(
        string $lang,
    ): self {
        return $this->withMeta([
            'lang' => $lang,
        ]);
    }

    public function component(): string
    {
        return 'weather-card';
    }
}
