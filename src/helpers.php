<?php

if (!function_exists('readableMemory')) {
    /**
     * readableMemory
     *
     * @param  mixed $memory
     * @param  bool $startFromBytes
     * @param  bool $withUnit
     * @return mixed
     */
    function readableMemory($memory, $startFromBytes = false, $withUnit = true)
    {
        $i = floor(log($memory) / log(1024));
        $sizes = ['KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
        if ($startFromBytes) array_unshift($sizes, 'B');

        if ($withUnit)
            return sprintf('%.02F', $memory / pow(1024, $i)) * 1 . ' ' . $sizes[$i];
        else return [
            'memory' => sprintf('%.02F', $memory / pow(1024, $i)) * 1,
            'unit' => $sizes[$i],
        ];
    }
}
