<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class WorldClockCard extends Card
{
    public $width = '1/3';

    public function timezones(
        $timezones,
    ): self {
        return $this->withMeta([
            'timezones' => $timezones,
        ]);
    }

    public function title(
        string $title = '',
    ): self {
        return $this->withMeta([
            'title' => $title,
        ]);
    }

    public function component(): string
    {
        return 'world-clock-card';
    }
}
