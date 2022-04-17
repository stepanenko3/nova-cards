<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class LinkableCard extends Card
{
    /**
     * Construct a new Card with a predefined theme.
     *
     * @param  string|null  $component
     * @return void
     */
    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'url' => '/',
            'title' => 'Linkable Card',
            'subtitle' => '',
            'target' => '_self',
        ]);
    }

    /**
     * Set URL which the Card should redirect to.
     *
     * @param  string  $url
     * @return $this
     */
    public function url(string $url): static
    {
        return $this->withMeta([
            'url' => $url,
        ]);
    }

    /**
     * Set title which will be shown on the Card.
     *
     * @param  string  $title
     * @return $this
     */
    public function title(string $title): static
    {
        return $this->withMeta([
            'title' => $title,
        ]);
    }

    /**
     * Set subtitle which will be shown on the Card.
     *
     * @param  string  $subtitle
     * @return $this
     */
    public function subtitle(string $subtitle): static
    {
        return $this->withMeta([
            'subtitle' => $subtitle,
        ]);
    }

    /**
     * Set the target of the Card on how to open the link (like in a new tab or window).
     *
     * @param  string  $target
     * @return $this
     */
    public function target(string $target): static
    {
        return $this->withMeta([
            'target' => $target,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component(): string
    {
        return 'linkable-card';
    }
}
