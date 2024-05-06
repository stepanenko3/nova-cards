<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Routing\Controller;
use Stepanenko3\LaravelSystemResources\Facades\SystemResources;

class SystemResourcesController extends Controller
{
    public function __invoke()
    {
        $ram = SystemResources::ram();
        $ramUsed = SystemResources::ramUsed();
        $ramTotal = SystemResources::ramTotal();

        $disk = SystemResources::disk();
        $diskUsed = SystemResources::diskUsed();
        $diskTotal = SystemResources::diskTotal();

        $cpuName = SystemResources::cpuName();
        $cpu = SystemResources::cpu();

        return response()->json([
            'disk_space' => [
                'total' => formatMemory(
                    size: $diskTotal,
                    level: 0,
                    asArray: true,
                    base: 1024,
                ),
                'used' => formatMemory(
                    size: $diskUsed,
                    level: 0,
                    asArray: true,
                    base: 1024,
                ),
                'use_percentage' => round($disk, 1),
            ],
            'memory_usage' => [
                'total' => formatMemory(
                    size: $ramTotal * 1024,
                    level: 0,
                    asArray: true,
                    base: 1024,
                ),
                'used' => formatMemory(
                    size: $ramUsed * 1024,
                    level: 0,
                    asArray: true,
                    base: 1024,
                ),
                'use_percentage' => round($ram, 1),
            ],
            'cpu_usage' => [
                'name' => $cpuName,
                'use_percentage' => $cpu,
            ],
        ]);
    }
}
