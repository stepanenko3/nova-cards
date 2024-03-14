<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Routing\Controller;
use Laravel\Nova\Nova;

class NovaInstalledVersionController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'installed_version' => Str::before(Nova::version(), ' '),
        ]);
    }
}
