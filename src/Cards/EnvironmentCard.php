<?php

namespace Stepanenko3\NovaCards\Cards;

use Laravel\Nova\Card;
use Stepanenko3\NovaCards\Traits\PollingTrait;

class EnvironmentCard extends Card
{
    use PollingTrait;

    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Construct a new Card with a predefined theme.
     *
     * @param null|string $component
     */
    public function __construct($component = null)
    {
        parent::__construct($component);
        $this->initPolling();
    }

    public function title($title = '')
    {
        return $this->withMeta([
            'title' => $title,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'environment-card';
    }
}
