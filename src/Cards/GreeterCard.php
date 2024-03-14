<?php

namespace Stepanenko3\NovaCards\Cards;

use Illuminate\Support\Traits\Conditionable;
use Laravel\Nova\Card;

class GreeterCard extends Card
{
    use Conditionable;

    public array $buttons = [];

    public $width = '1/3';

    public function __construct($component = null)
    {
        parent::__construct($component);

        $this->withMeta([
            'user_name' => auth()->user()?->name ?? __('Dear User'),
            'buttons' => $this->buttons,
        ]);
    }

    public function user(?string $name = null, ?string $title = null): static
    {
        return $this->withMeta([
            'user_name' => $name ?? (auth()->user()?->name ?? __('Dear User')),
            'user_title' => $title,
        ]);
    }

    public function message(string $text): static
    {
        return $this->withMeta([
            'message' => $text,
        ]);
    }

    public function avatar(string $url): static
    {
        return $this->withMeta([
            'avatar' => true,
            'avatar_url' => $url,
        ]);
    }

    public function button(
        string $name,
        string $target,
        ?string $style = null,
    ): static {
        $this->buttons[] = [
            'name' => $name,
            'target' => $target,
            'style' => $style,
        ];

        return $this->withMeta([
            'buttons' => $this->buttons,
        ]);
    }

    public function stats(array $stats): static
    {
        if (count($stats) > 3) {
            $stats = array_slice($stats, 0, 3);
        }

        return $this->withMeta(['stats' => $stats]);
    }

    public function verified(
        bool $verified = true,
        ?string $text = null,
    ): static {
        return $this->withMeta([
            'verified' => $verified,
            'verified_text' => $text,
        ]);
    }

    public function style(
        ?string $extend = null,
        ?string $override = null,
    ): static {
        return $this->withMeta([
            'style_extend' => $extend,
            'style_override' => $override,
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'greeter-card';
    }
}
