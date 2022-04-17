<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class PercentageCard extends Card
{
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

        $this->withMeta([
            'name' => '',
            'label' => '',
            'count' => 0,
            'total' => 0,
            'percentagePrecision' => 2,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'percentage-card';
    }

    public function name(string $text): static
    {
        return $this->withMeta(['name' => $text]);
    }

    public function label(string $text): static
    {
        return $this->withMeta(['label' => $text]);
    }

    public function count(int $count): static
    {
        return $this->withMeta(['count' => $count]);
    }

    public function total(int $count): static
    {
        return $this->withMeta(['total' => $count]);
    }

    public function percentagePrecision(int $precision): static
    {
        return $this->withMeta(['percentagePrecision' => $precision]);
    }
}
