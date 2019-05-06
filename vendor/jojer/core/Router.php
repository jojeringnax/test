<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 14:29
 */

namespace jojer\core;


class Router
{
    public function start()
    {
        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        $routing = [
            "/" => ['controller' => 'Main', 'action' => 'index'],
            "/login" => ['controller' => 'Main', 'action' => 'login'],
            "/register" => ['controller' => 'User', 'action' => 'create'],
            "/logout" => ['controller' => 'Main', 'action' => 'logout'],
            "/admin" => ['controller' => 'Main', 'action' => 'admin'],
            "/task/show" => ['controller' => 'Task', 'action' => 'show'],
            "/task/edit" => ['controller' => 'Task', 'action' => 'edit'],
            "/task/delete" => ['controller' => 'Task', 'action' => 'delete'],
            "/task/create" => ['controller' => 'Task', 'action' => 'create']
        ];
        if (isset($routing[$route])) {
            $controllerObjName = 'app\\controllers\\' . $routing[$route]['controller'] . 'Controller';
            $controller = new $controllerObjName;
            $action = $routing[$route]['action'];
            $controller->$action();
        } else {
            echo 'Not access';
        }
    }

}