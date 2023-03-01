<?php

namespace Stepanenko3\NovaCards\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CacheController extends Controller
{
    public function flush(): array
    {
        /**
         * Throw something in the cache to make sure there is a valid connection. This also ensures that
         * the proper directories have been created for the 'file' cache driver.
         */
        Cache::forever('flushing', true);
        $canCacheSuccessfully = Cache::get('flushing');

        return [
            'success' => $canCacheSuccessfully && Cache::flush(),
            'size' => self::getFileCacheSize(),
        ];
    }

    public function forget(Request $request): array
    {
        $key = $request->get('cacheKey');

        return [
            'success' => Cache::forget($key),
            'key' => htmlentities($key),
            'size' => self::getFileCacheSize(),
        ];
    }

    public function get(Request $request): array
    {
        $key = $request->get('cacheKey');
        $result = Cache::get($key);

        return [
            'success' => (bool)$result,
            'key' => htmlentities($key),
            'value' => $result,
            'size' => self::getFileCacheSize(),
        ];
    }

    public function load()
    {
        return [
            'success' => true,
            'size' => self::getFileCacheSize(),
        ];
    }

    /**
     * Returns the size of a folder in bytes.
     *
     * @param string $folder
     * @return int
     */
    public static function getFolderSizeInBytes($folder)
    {
        $size = 0;
        foreach (glob(rtrim($folder, '/').'/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : self::getFolderSizeInBytes($each);
        }
        return $size;
    }

    /**
     * Converts a file size from bytes to a human readable string.
     *
     * @param int $size
     * @return string
     */
    public static function sizeInBytesToReadable($size)
    {
        if ($size < 1024) {
            $size = $size." Bytes";
        } else if ($size < 1048576 && $size > 1023) {
            $size = round($size / 1024, 1) . " KB";
        } else if ($size < 1073741824 && $size > 1048575) {
            $size = round($size / 1048576, 1) . " MB";
        } else {
            $size = round($size / 1073741824, 1) . " GB";
        }

        return $size;
    }

    /**
     * Returns the current size of the local file cache if it is enabled.
     *
     * @return string
     */
    public static function getFileCacheSize()
    {
        switch(config('cache.default')) {
            case 'file':
                $path = config('cache.stores.file.path');
                if (!file_exists($path)) return '';

                $sizeInBytes = self::getFolderSizeInBytes($path);
                break;

            default:
                return true;
        }

        return self::sizeInBytesToReadable($sizeInBytes);
    }
}
