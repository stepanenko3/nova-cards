<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

/**
 * A simple embedding widget card to allow the integration of an url
 * or <iframe>...</iframe> context on e.g. a dashboard.
 */
class EmbedCard extends Card
{
    /**
     * @param $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'url' => false,
            'hasPadding' => true,
        ]);
    }

    /**
     * The url to embed
     *
     * @param string $url The url to load into an <iframe>...</iframe>
     * @return EmbedCard
     */
    public function url(string $url)
    {
        return $this->withMeta(['url' => $url]);
    }

    /**
     * The url to embed
     *
     * @param string $url The url to load into an <iframe>...</iframe>
     * @return EmbedCard
     */
    public function withoutPadding()
    {
        return $this->withMeta(['hasPadding' => false]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'embed-card';
    }
}
