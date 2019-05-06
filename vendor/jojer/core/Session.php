<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 15:24
 */

namespace jojer\core;


use app\models\User;

class Session
{


    public static function start()
    {
        session_name('jojer');
        session_start();
        self::checkApp();
    }

    public static function checkApp()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['uid'])) {
            App::$isGuest = false;
            App::$user = User::find()->where('id','=',$_SESSION['uid'])->get()[0];
        }
        if (isset($_SESSION['user']) && $_SESSION['admin'])
        {
            App::$isAdmin = true;
        }
    }

    public static function unsetParams($keys)
    {
        foreach ($keys as $key) {
            unset($_SESSION[$key]);
        }
    }


    public static function stop()
    {
        session_destroy();
    }

    /**
     * @param $arr
     */
    public static function set($arr) {
        foreach ($arr as $key => $value) {
            $_SESSION[$key] = $value;
        }
        return;
    }

}