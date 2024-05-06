<?php

namespace Stepanenko3\NovaCards\Cards;

use Carbon\Carbon;
use Laravel\Nova\Card;

class CountdownCard extends Card
{
    public $width = '1/3';

    public function label(
        string $label,
    ): self {
        return $this->withMeta([
            'label' => $label,
        ]);
    }

    public function title(
        string $title = '',
    ): self {
        return $this->withMeta([
            'title' => $title,
        ]);
    }

    public function to(
        Carbon $date,
    ): self {
        return $this->withMeta([
            'to' => $date->timestamp * 1000,
        ]);
    }

    public function component(): string
    {
        return 'countdown-card';
    }
}
