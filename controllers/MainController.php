<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 09:28
 */

namespace app\controllers;
use app\models\Task;
use app\models\User;
use jojer\core\App;
use jojer\core\Controller;
use jojer\core\Session;

class MainController extends Controller
{
    /**
     * @var string
     */
    public $layout = APP_DIR.'views/layouts/normal.php';


    public function index()
    {
        $this->render('/','index');
    }

    public function admin()
    {
        $this->render('admin', 'index', [
            'tasks' => Task::all()
        ]);
    }


    public function login()
    {
        if (!App::$isGuest) {
            header('Location: /admin');
        }
        $error = '';
        if (!empty($_POST)) {
            $user = User::find()
                ->where('username', '=', $_POST['username'])
                ->where('password', '=', md5($_POST['password']))
                ->get();
            if($user !== []) {
                $user = $user[0];
                Session::set(['user' => $user->username, 'admin' => $user->admin, 'uid' => $user->id]);
                header('Location: /admin');
            } else {
                $error = 'Error';
            }

        }
        $this->render('/', 'login', [
            'error' => $error
        ]);
    }

    public function logout()
    {
        Session::unsetParams(['user', 'admin', 'uid']);
        header("Location: /login");
    }

}