<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use DB;
use Laravel\Nova\Nova;

class VersionsController
{
    public function index()
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

        if (! in_array(config('database.default'), $knownDatabases)) {
            return 'Unkown';
        }

        $results = DB::select(DB::raw("select version()"));

        return config('database.default') . ' ' . $results[0]->{'version()'};
    }
}
