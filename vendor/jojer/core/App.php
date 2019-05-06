<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 15:13
 */

namespace jojer\core;


class App
{
    /**
     * App constructor.
     */
    private function __construct()
    {
    }

    /**
     * @var array
     */
    public static $db;

    /**
     * @var boolean
     */
    public static $isGuest=true;

    /**
     * @var null
     */
    public static $user=null;
    /**
     * @var boolean
     */
    public static $isAdmin=false;

    /**
     * @var \mysqli
     */
    public static $mysqli;


    public static function start()
    {
        self::$db = require_once CONFIG_DIR.'database.php';
        self::$mysqli = new \mysqli(self::$db['host'], self::$db['user'], self::$db['password'], self::$db['name'], self::$db['port']);
        (new ErrorHandler())->register();
    }



}