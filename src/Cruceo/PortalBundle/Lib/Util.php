<?php
namespace Cruceo\PortalBundle\Lib;

class Util {

    private static $table = array(
        '(' => '', ')' => '', '!' => '', '$' => '', '?' => '', ':' => '', ',' => '', '&' => '', '+' => '', '-' => '', '/' => '', '.' => '', 'Š' => 'S',
        'Œ' => 'O', 'Ž' => 'Z', 'š' => 's', 'œ' => 'o', 'ž' => 'z', 'Ÿ' => 'Y', '¥' => 'Y', 'µ' => 'u', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A',
        'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
        'Ý' => 'Y', 'ß' => 's', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e',
        'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ÿ' => 'y', 'ÿ' => 'y', ' ' => ''
    );

    /**
     * Removes invalid characters
     *
     * @param text $str
     */
    public static function sanitizeString($str, array $allowed = array(), array $change = array())
    {
        $table = self::$table;

        if (count($change)) {
            foreach ($change as $k => $v) {
                $table[$k] = $v;
            }
        }

        if (count($allowed)) {
            foreach ($allowed as $k) {
                unset($table[$k]);
            }
        }

        return str_replace(array_keys($table), array_values($table), $str);
    }

    public static function deleteDir($path)
    {
        $iterator = new \RecursiveDirectoryIterator($path);
        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);

        foreach($files as $file) {
            if ($file->isDir()) {
                rmdir($file->getRealPath());
            } else {
                unlink($file->getRealPath());
            }
        }

        rmdir($path);
    }

}