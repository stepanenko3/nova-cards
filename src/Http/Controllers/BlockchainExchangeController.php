<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BlockchainExchangeController
{
    public function __invoke()
    {
        $data = Cache::remember(
            'blockchain-exchange-rates::ticker',
            10,
            fn () => Http::get('https://blockchain.info/ticker')->json(),
        );

        return response()->json($data);
    }
}
