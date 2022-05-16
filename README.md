# Cards for Laravel Nova

[![Latest Version on Packagist](https://img.shields.io/packagist/v/stepanenko3/nova-cards.svg?style=flat-square)](https://packagist.org/packages/stepanenko3/nova-cards)
[![Total Downloads](https://img.shields.io/packagist/dt/stepanenko3/nova-cards.svg?style=flat-square)](https://packagist.org/packages/stepanenko3/nova-cards)
[![License](https://poser.pugx.org/stepanenko3/nova-cards/license)](https://packagist.org/packages/stepanenko3/nova-cards)

## List of Cards

- BlockchainExchangeCard
- CacheCard
- CountdownCard
- EmbedCard
- EnvironmentCard
- HtmlCard
- LinkableCard
- PercentageCard
- ScheduledJobsCard
- SslCard
- SystemResourcesCard
- VersionsCard
- WorldClockCard
- WeatherCard
- CalendarCard
- NovaReleaseCard

## Requirements

- `php: >=8.0`
- `laravel/nova: ^4.0`

## Installation

```bash
# Install the package
composer require stepanenko3/nova-cards
```

## Usage
Register the cards with Nova in the `cards()` method of the your Dashboards class:

```php
// in app/Nova/Dashborads/Cards.php

use Stepanenko3\NovaCards\Cards\BlockchainExchangeCard;
use Stepanenko3\NovaCards\Cards\CacheCard;
use Stepanenko3\NovaCards\Cards\CountdownCard;
use Stepanenko3\NovaCards\Cards\EmbedCard;
use Stepanenko3\NovaCards\Cards\EnvironmentCard;
use Stepanenko3\NovaCards\Cards\HtmlCard;
use Stepanenko3\NovaCards\Cards\LinkableCard;
use Stepanenko3\NovaCards\Cards\PercentageCard;
use Stepanenko3\NovaCards\Cards\ScheduledJobsCard;
use Stepanenko3\NovaCards\Cards\SslCard;
use Stepanenko3\NovaCards\Cards\SystemResourcesCard;
use Stepanenko3\NovaCards\Cards\VersionsCard;
use Stepanenko3\NovaCards\Cards\WorldClockCard;
use Stepanenko3\NovaCards\Cards\WeatherCard;
use Stepanenko3\NovaCards\Cards\CalendarCard;
use Stepanenko3\NovaCards\Cards\NovaReleaseCard;

public function cards()
{
    return [
        (new WeatherCard)
            ->pollingTime(60000)
            ->startPolling(),

        (new CalendarCard),

        (new LinkableCard)
            ->title('Docs')
            ->subtitle('subtitle')
            ->url('/')
            ->target('_blank'),

        (new CacheCard),

        (new SystemResourcesCard),

        (new VersionsCard),

        (new ScheduledJobsCard)
            ->startPolling()
            ->pollingTime(1000)
            ->width('1/2'),

        (new BlockchainExchangeCard)
            ->width('1/2'),

        (new NovaReleaseCard),

        (new EnvironmentCard),

        (new SslCard)
            ->domain('snotax.com'),

        (new SslCard)
            ->domain('laravel.com'),

        (new HtmlCard)
            ->width('1/3')
            ->html('<h1>Hello World!</h1>'),

        // (new HtmlCard)
        //     ->width('1/3')
        //     ->markdown('# Hello World!'),

        // (new HtmlCard)->width('1/3')->view('cards.hello', ['name' => 'World']),

        (new PercentageCard)
            ->name('Demo percents')
            ->label('$')
            ->count(33)
            ->total(1000)
            ->percentagePrecision(2),

        (new CountdownCard)
            ->to(now()->addDays(30))
            ->label('30 Days Later'),

        (new WorldClockCard())
            ->timezones([
                'Europe/Kiev',
                'Asia/Tehran',
                'America/new_york',
                'America/los_angeles',
            ])
            ->timeFormat('H:i:s') //Optional time format default is: 'h:i:s'
            ->startPolling()
            ->pollingTime(1000)
            ->title(__('World Clock')),

        // A most simple embed
        (new EmbedCard)
            ->url('https://www.youtube.com/embed/WhWc3b3KhnY'),

        // A more complex embed of raw <iframe>...</iframe> HTML
        (new EmbedCard)
            ->withoutPadding()
            ->url('https://www.youtube.com/embed/WhWc3b3KhnY'),
    ];
}
```

## Credits

- [Artem Stepanenko](https://github.com/stepanenko3)

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).
