<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class CacheCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Construct a new Card with a predefined theme.
     *
     * @param  string|null  $component
     * @return void
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        return $this->withMeta([
            'defaultDriver' => ucwords(config('cache.default')),
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'cache-card';
    }
}
