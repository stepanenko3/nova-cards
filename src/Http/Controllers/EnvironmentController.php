<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

class EnvironmentController
{
    public function __invoke()
    {
        return config('app.env', 'unknown');
    }
}
