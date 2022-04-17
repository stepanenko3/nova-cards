<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Routing\Controller;
use SystemResources;

class SystemResourcesController extends Controller
{
    public function index()
    {
        $ram = SystemResources::ram();
        $ramUsed = SystemResources::ramUsed();
        $ramTotal = SystemResources::ramTotal();

        $disk = SystemResources::disk();
        $diskUsed = SystemResources::diskUsed();
        $diskTotal = SystemResources::diskTotal();

        $cpuName = SystemResources::cpuName();
        $cpu = SystemResources::cpu();

        return [
            'disk_space' => [
                'total' => readableMemory($diskTotal, true, false),
                'used' => readableMemory($diskUsed, true, false),
                'use_percentage' => round($disk, 1),
            ],
            'memory_usage' => [
                'total' => readableMemory($ramTotal, false, false),
                'used' => readableMemory($ramUsed, false, false),
                'use_percentage' => round($ram, 1),
            ],
            'cpu_usage' => [
                'name' => $cpuName,
                'use_percentage' => $cpu,
            ],
        ];
    }

}
