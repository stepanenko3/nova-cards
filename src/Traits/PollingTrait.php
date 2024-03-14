<?php

namespace Stepanenko3\NovaCards\Traits;

trait PollingTrait
{
    /**
     * Create a new element.
     *
     * @param null|string $component
     */
    public function initPolling(): void
    {
        $this->withMeta([
            'polling' => true,
            'pollingStart' => false,
            'pollingTime' => 5000,
        ]);
    }

    public function startPolling(): static
    {
        return $this->withMeta([
            'pollingStart' => true,
        ]);
    }

    public function pollingTime(int $ms = 1000): static
    {
        return $this->withMeta([
            'pollingTime' => $ms,
        ]);
    }
}
