<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class SystemResourcesCard extends Card
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
            'pollingTime' => 10000,
        ]);
    }

    public function title($title = '')
    {
        return $this->withMeta([
            'title' => $title
        ]);
    }

    public function pollingTime(int $ms): static
    {
        return $this->withMeta([
            'pollingTime' => $ms,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'system-resources-card';
    }
}
