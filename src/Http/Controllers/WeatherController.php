<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class WeatherController
{
    public function __invoke(Request $request)
    {
        $data = Cache::remember(
            'nova-weather-card:' . implode('-', [
                $request->input('q', 'Kiev'),
                $request->input('units', 'metric'),
                config('app.locale'),
            ]),
            10,
            fn () => Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'q' => $request->input('q', 'Kiev'),
                'appid' => '7b953cd64fff98f036b7513d75ba3a17',
                'units' => $request->input('units', 'metric'),
            ])->json(),
        );

        return response()->json($data);
    }
}
