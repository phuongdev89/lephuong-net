<?php
/**
 * Created by PhpStorm.
 * User: phuon
 * Date: 31/07/2017
 * Time: 11:05 SA
 */

namespace common\helpers;
class StringHelper
{

    /**
     * @param        $convert
     * @param string $char
     *
     * @return mixed|string
     */
    public static function removeSign($convert, $char = "_")
    {
        $vietnameseChar = "à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|ì|í|ị|ỉ|ĩ|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|ỳ|ý|ỵ|ỷ|ỹ|đ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|Ì|Í|Ị|Ỉ|Ĩ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|Đ";
        $unicodeChar = "a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|i|i|i|i|i|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|I|I|I|I|I|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|Y|Y|Y|Y|Y|D";
        $vietnameseChars = explode("|", $vietnameseChar);
        $unicodeChars = explode("|", $unicodeChar);
        $str = strtolower(str_replace($vietnameseChars, $unicodeChars, $convert));
        $str = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $str = preg_replace("/[\/_|+ -]+/", $char, $str);
        return $str;
    }

    /**
     * @param int $length
     * @param bool $is_hex
     *
     * @return string
     */
    public static function random($length = 10, $is_hex = false)
    {
        if ($is_hex) {
            $characters = '0123456789abcdef';
        } else {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param int $length
     *
     * @return string
     */
    public static function randomUppercase($length = 10)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @param     $str
     *
     * @param int $length
     *
     * @return string
     */
    public static function nameHiddenRandom($str, $length = 3)
    {
        $string = substr(str_shuffle($str), 0, $length);
        foreach (str_split($string) as $item) {
            $str = str_replace($item, '*', $str);
        }
        return $str;
    }

    /**
     * @param     $str
     *
     * @param int $length
     *
     * @return string
     */
    public static function mailHiddenRandom($str, $length = 5)
    {
        $start = mt_rand(0, strlen($str) - $length);
        $string = substr($str, $start, $start + $length);
        $str = str_replace($string, str_pad('', $length, '*'), $str);
        return $str;
    }

    /**
     * @param     $file
     * @param     $content
     * @param int $flag
     */
    public static function log($file, $content, $flag = FILE_APPEND)
    {
        file_put_contents($file, date('Y-m-d H:i:s') . ' ' . $content . PHP_EOL, $flag);
    }

    /**
     * @param $string
     *
     * @return string
     */
    public static function strToHex($string)
    {
        $hex = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $ord = ord($string[$i]);
            $hexCode = dechex($ord);
            $hex .= substr('0' . $hexCode, -2);
        }
        return strToUpper($hex);
    }

    /**
     * @param $hex
     *
     * @return string
     */
    public static function hexToStr($hex)
    {
        $string = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
        }
        return $string;
    }

    /**
     * @param       $haystack
     * @param array $needles
     * @param int $offset
     *
     * @return false|mixed
     */
    public static function strposa($haystack, $needles = array(), $offset = 0)
    {
        $chr = array();
        foreach ($needles as $needle) {
            $res = strpos($haystack, $needle, $offset);
            if ($res !== false) {
                $chr[$needle] = $res;
            }
        }
        if (empty($chr)) {
            return false;
        }
        return min($chr);
    }


    /**
     * @param $string
     *
     * @return bool
     */
    public static function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
