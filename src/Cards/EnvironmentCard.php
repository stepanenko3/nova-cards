<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class EnvironmentCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    public function title($title = '')
    {
        return $this->withMeta([
            'title' => $title
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'environment-card';
    }
}
