<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 15:06
 */

namespace app\controllers;


use app\models\User;
use jojer\core\Controller;

class UserController extends Controller
{

    public function create()
    {
        if (!empty($_POST)) {
            $user = new User();
            $user->fill($_POST);
            if(!isset($_POST['admin'])) {
                $user->admin = 0;
            }
            $user->password = md5($_POST['password']);
            $user->save();
            header("Location: /login");
        }
        $this->render('/', 'register');
        return true;
    }

}