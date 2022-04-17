<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class SslCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    public function __construct(string $domain = null)
    {
        $domain = $domain ?: request()->getHost();

        $this->withMeta(compact('domain'));
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'ssl-card';
    }
}
