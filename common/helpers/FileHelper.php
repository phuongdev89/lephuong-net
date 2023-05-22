<?php
/**
 * Created by Le Phuong.
 * @file     FileHelper.php
 * @project  lephuong-net
 * @author   Phuong Dev <phuongdev89@gmail.com>
 * @datetime 5/23/2023 1:41 AM
 */

namespace common\helpers;

class FileHelper
{

    /**
     * @param $pattern
     * @param $flags
     * @return   array|false
     * @author   Phuong Dev <phuongdev89@gmail.com>
     * @datetime 5/23/2023 1:42 AM
     *
     */
    public static function globRecursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, self::globRecursive($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }
}
