<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class WorldClockController
{
    public function __invoke(Request $request)
    {
        $times = [];

        foreach ($request->input('timezones', []) as $timezone) {
            $time = Carbon::now($timezone);
            $night = (int) $time->format('H') > 17;
            $name = explode('/', $time->getTimezone()->getName())[1];
            $name = str_replace('_', ' ', $name);

            $times[] = [
                'name' => __(ucwords($name)),
                'time' => $time->format($request->input('timeFormat', 'H:i:s')),
                'night' => $night,
            ];
        }

        return $times;
    }
}
