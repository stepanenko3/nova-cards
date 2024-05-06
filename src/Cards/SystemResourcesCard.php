<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;
use Stepanenko3\NovaCards\Traits\PollingTrait;

class SystemResourcesCard extends Card
{
    use PollingTrait;

    public $width = '1/3';

    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->initPolling();
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
        return 'system-resources-card';
    }
}
