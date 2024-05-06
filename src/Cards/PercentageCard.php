<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class PercentageCard extends Card
{
    public $width = '1/3';

    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->withMeta([
            'name' => '',
            'label' => '',
            'count' => 0,
            'total' => 0,
            'percentagePrecision' => 2,
        ]);
    }

    public function name(
        string $text,
    ): self {
        return $this->withMeta([
            'name' => $text,
        ]);
    }

    public function label(
        string $text,
    ): self {
        return $this->withMeta([
            'label' => $text,
        ]);
    }

    public function count(
        int $count,
    ): self {
        return $this->withMeta([
            'count' => $count,
        ]);
    }

    public function total(
        int $count,
    ): self {
        return $this->withMeta([
            'total' => $count,
        ]);
    }

    public function percentagePrecision(
        int $precision,
    ): self {
        return $this->withMeta([
            'percentagePrecision' => $precision,
        ]);
    }

    public function component(): string
    {
        return 'percentage-card';
    }
}
