<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class EmbedCard extends Card
{
    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->withMeta([
            'url' => false,
            'hasPadding' => true,
        ]);
    }

    public function url(
        string $url,
    ): self {
        return $this->withMeta([
            'url' => $url,
        ]);
    }

    public function withoutPadding(): self
    {
        return $this->withMeta([
            'hasPadding' => false,
        ]);
    }

    public function component(): string
    {
        return 'embed-card';
    }
}
