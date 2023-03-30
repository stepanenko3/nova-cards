<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Laravel\Nova\Nova;

class VersionsController
{
    public function __invoke()
    {
        return [
            'os' => php_uname('s') . ' (' . php_uname('r') . ' - ' . php_uname('v') . ')',
            'php' => phpversion(),
            'database' => $this->getDatabase(),
            'laravel' => app()->version(),
            'nova' => Nova::version(),
        ];
    }

    private function getDatabase()
    {
        $knownDatabases = [
            'sqlite',
            'mysql',
            'pgsql',
            'sqlsrv',
        ];

        if (!in_array(config('database.default'), $knownDatabases)) {
            return 'Unkown';
        }


        $results = DB::select("select version()");

        return config('database.default') . ' ' . ((array) $results[0])['version()'];
    }
}
