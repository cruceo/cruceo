<?php
namespace Cruceo\PortalBundle\Lib;

class Util {

    static private $widthThumb = 75;

    static private $extensions = array('png', 'gif', 'jpg');

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
    static public function sanitizeString($str, array $allowed = array(), array $change = array())
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

    static public function deleteDir($path)
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

    static public function generateSlug($str)
    {
        $str = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $str = preg_replace("/[^a-zA-Z0-9\/_| -]/", '', $str);
        $str = strtolower(trim($str, '-'));
        $str = preg_replace("/[\/_| -]+/", '-', $str);

        return $str;
    }

    static public function createThumbs($path, \Doctrine\ORM\PersistentCollection $photos = null)
    {
        $pathThumbs = $path.DIRECTORY_SEPARATOR.'thumbs';

        if (is_dir($pathThumbs)) {
            return;
        }

        if (count($photos))
        {
            @mkdir($pathThumbs);

            foreach ($photos as $photo) {
                $image = $path.DIRECTORY_SEPARATOR.$photo->getRuta();
                $info  = pathinfo($image);

                if (in_array($info['extension'], self::$extensions)) {
                    $function  = 'imagecreatefrom'.($info['extension'] == 'jpg' ? 'jpeg' : $info['extension']);

                    $imgGD = $function($image);

                    $width   = imagesx($imgGD);
                    $height  = imagesy($imgGD);
                    $nHeight = floor($height * (self::$widthThumb / $width));
                    $thumb   = imagecreatetruecolor(self::$widthThumb, $nHeight);

                    imagecopyresized($thumb, $imgGD, 0, 0, 0, 0, self::$widthThumb, $nHeight, $width, $height);

                    $function = 'image'.($info['extension'] == 'jpg' ? 'jpeg' : $info['extension']);

                    $function($thumb, $pathThumbs.DIRECTORY_SEPARATOR.$photo->getRuta());

                    imagedestroy($thumb);
                }
            }
        }
    }

}