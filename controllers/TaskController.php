<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 14:45
 */

namespace app\controllers;


use app\models\Task;
use jojer\core\App;
use jojer\core\Controller;

/**
 * Class TaskController
 * @package app\controllers
 */
class TaskController extends Controller
{

    /**
     * @return bool
     * @throws \Exception
     */
    public function show()
    {
        $task = Task::find()->where('id','=', $_GET['id'])->get();
        if (empty($task)) {
            throw new \Exception('No access');
        }
        $this->render('admin', 'show', [
            'task' => $task[0]
        ]);
        return true;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function edit()
    {
        $task = Task::find()->where('id','=', $_GET['id'])->get();
        if (empty($task)) {
            throw new \Exception('No access');
        }
        $task = $task[0];
        if (!App::$isAdmin) {
            header("Location: /task/show?id=$task->id");
        }
        /**
         * @var $task Task
         */
        if (!empty($_POST)) {
            $task->fill($_POST);
            if(!isset($_POST['status'])) {
                $task->status = 0;
            }
            $task->save();
            header("Location: /task/show?id=$task->id");
        }
        $this->render('admin', 'edit', [
            'task' => $task
        ]);
        return true;
    }

    /**
     * @return bool
     */
    public function create()
    {
        if (!empty($_POST)) {
            $task = new Task();
            $task->fill($_POST);
            if(!isset($_POST['status'])) {
                $task->status = 0;
            }
            $task->save();
            header("Location: /task/show?id=$task->id");
        }
        $this->render('admin', 'create');
        return true;
    }

    /**
     * @throws \Exception
     */
    public function delete()
    {
        $task = Task::find()->where('id','=', $_GET['id'])->get();
        if (empty($task)) {
            throw new \Exception('No access');
        }
        $task = $task[0];
        $task->delete();
        header("Location: /admin");
    }
}