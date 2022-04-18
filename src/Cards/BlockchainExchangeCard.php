<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;

class BlockchainExchangeCard extends Card
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

    public function pollingTime(int $ms): static
    {
        return $this->withMeta(['pollingTime' => $ms]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'blockchain-exchange-card';
    }
}
