<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;
use Stepanenko3\NovaCards\Traits\PollingTrait;

class SslCard extends Card
{
    use PollingTrait;

    public $width = '1/3';

    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->initPolling();
    }

    public function domain(
        ?string $domain = null
    ): self {
        $domain = $domain ?: request()->getHost();

        return $this->withMeta([
            'domain' => $domain,
        ]);
    }

    public function component(): string
    {
        return 'ssl-card';
    }
}
