<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class EnvironmentCard extends Card
{
    public $width = '1/3';

    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->withMeta([
            'env' => config('app.env'),
        ]);
    }

    public function title(
        string $title = '',
    ): self {
        return $this->withMeta([
            'title' => $title,
        ]);
    }

    public function component(): string
    {
        return 'environment-card';
    }
}
