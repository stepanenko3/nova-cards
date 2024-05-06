<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class LinkableCard extends Card
{
    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->withMeta([
            'url' => '/',
            'title' => 'Linkable Card',
            'subtitle' => '',
            'target' => '_self',
        ]);
    }

    public function url(
        string $url,
    ): self {
        return $this->withMeta([
            'url' => $url,
        ]);
    }

    public function title(
        string $title,
    ): self {
        return $this->withMeta([
            'title' => $title,
        ]);
    }

    public function subtitle(
        string $subtitle,
    ): self {
        return $this->withMeta([
            'subtitle' => $subtitle,
        ]);
    }

    public function target(
        string $target,
    ): self {
        return $this->withMeta([
            'target' => $target,
        ]);
    }

    public function component(): string
    {
        return 'linkable-card';
    }
}
