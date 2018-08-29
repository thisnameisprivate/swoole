<?php
/*
 *  清除php文件注释和多余的空格
 *
 * */


class Something {
    private static $instance = null;
    private $name = 'This is instance Test';
    private function __construct()
    {

    }
    public static function instance ($methods)
    {
        if (! self::$instance == null) {
            return self::$instance;
        } else {
            print_r($methods);
            return self::$instance = new Something;
        }
    }
    public function getMethods ()
    {
        return $this->name;
    }
}
$methods = 'Hello, GirlFriend.';
$something = Something::instance($methods);
$result = $something->getMethods();
print_r($result);