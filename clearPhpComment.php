<?php
/*
 *  清除php文件注释和多余的空格
 *
 * */
// open on need comment php file Header to clear.
$phpCode =  php_strip_whitespace('D:\wampserver\wamp\www\ThinkPHP\App\Home\Controller\IndexController.class.php');
// create file.
$myfile = fopen("IndexController.class.php", "w") or die("Unable to open file!");
// write new phpcode file.
fwrite($myfile, $phpCode);
// close header resource link
fclose($myfile);

class Something {
    private static $instance = null;
    private function __construct()
    {

    }
    public static function instance ()
    {
        if (! self::$instance == null) {
            return self::$instance = new Something;
        } else {
            return self::$instance;
        }
    }
}

$something = Something::instance();
var_dump($something);