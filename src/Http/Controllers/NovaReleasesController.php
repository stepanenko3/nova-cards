<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Parsedown;

class NovaReleasesController extends Controller
{
    public function __invoke()
    {
        $data = Cache::remember('stepanenko3-nova-cards::releases', 60, function () {
            // @todo: Cache it on novapackages.com so as to save load on the Nova folks <3
            $response = Http::get('https://nova.laravel.com/api/releases')->json();

            $response['releases'] = collect($response['releases'])->map(function ($release) {
                $release['html_notes'] = (new Parsedown)->text($release['notes']);
                return $release;
            })->toArray();

            return $response;
        });

        return response()->json($data);
    }
}
