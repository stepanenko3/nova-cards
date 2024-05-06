<?php

namespace Stepanenko3\NovaCards\Cards;

use Illuminate\Support\Facades\App;
use Laravel\Nova\Card;
use Stepanenko3\NovaCards\MarkdownConverter;

class HtmlCard extends Card
{
    public $width = '1/3';

    public function __construct(
        $component = null,
    ) {
        parent::__construct($component);

        $this->withMeta([
            'center' => false,
            'withoutCardStyles' => false,
            'content' => '',
        ]);
    }

    public function html(
        string $htmlContent,
    ): self {
        return $this->withMeta([
            'content' => $htmlContent,
        ]);
    }

    public function markdown(
        string $markdownContent,
    ): self {
        $htmlContent = App::make(MarkdownConverter::class)::parse($markdownContent)
            ->toHtml();

        return $this->html(
            htmlContent: $htmlContent,
        );
    }

    public function view(
        string $view,
        array $viewData = [],
    ): self {
        $htmlContent = view($view, $viewData)
            ->render();

        return $this->html(
            htmlContent: $htmlContent,
        );
    }

    public function center(
        bool $centerContent = true,
    ): self {
        return $this->withMeta([
            'center' => $centerContent,
        ]);
    }

    public function withoutCardStyles(
        bool $withoutStyles = true,
    ): self {
        return $this->withMeta([
            'withoutCardStyles' => $withoutStyles,
        ]);
    }

    public function component(): string
    {
        return 'html-card';
    }
}
