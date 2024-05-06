<?php

namespace Stepanenko3\NovaCards\Cards;

use Illuminate\Support\Traits\Conditionable;
use Laravel\Nova\Card;

class GreeterCard extends Card
{
    use Conditionable;

    public array $buttons = [];

    public $width = '1/3';

    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->withMeta([
            'user_name' => auth()->user()?->name ?? __('Dear User'),
            'buttons' => $this->buttons,
        ]);
    }

    public function user(
        ?string $name = null,
        ?string $title = null,
    ): self {
        return $this->withMeta([
            'user_name' => $name ?? (auth()->user()?->name ?? __('Dear User')),
            'user_title' => $title,
        ]);
    }

    public function message(
        string $text,
    ): self {
        return $this->withMeta([
            'message' => $text,
        ]);
    }

    public function avatar(
        string $url,
    ): self {
        return $this->withMeta([
            'avatar' => true,
            'avatar_url' => $url,
        ]);
    }

    public function button(
        string $name,
        string $target,
        ?string $style = null,
    ): self {
        $this->buttons[] = [
            'name' => $name,
            'target' => $target,
            'style' => $style,
        ];

        return $this->withMeta([
            'buttons' => $this->buttons,
        ]);
    }

    public function stats(
        array $stats,
    ): self {
        if (count($stats) > 3) {
            $stats = array_slice($stats, 0, 3);
        }

        return $this->withMeta([
            'stats' => $stats,
        ]);
    }

    public function verified(
        bool $verified = true,
        ?string $text = null,
    ): self {
        return $this->withMeta([
            'verified' => $verified,
            'verified_text' => $text,
        ]);
    }

    public function style(
        ?string $extend = null,
        ?string $override = null,
    ): self {
        return $this->withMeta([
            'style_extend' => $extend,
            'style_override' => $override,
        ]);
    }

    public function component(): string
    {
        return 'greeter-card';
    }
}
