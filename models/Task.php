<?php


namespace app\models;


use jojer\core\Model;

/**
 * Class Task
 * @package app\models
 */
class Task extends Model
{
    /**
     * @var string
     */
    public static $table = 'tasks';

    /**
     * @var array
     */
    public static $attributes = [
        'username',
        'email',
        'content',
        'status'
    ];


    /**
     * @return array
     */
    public static function number()
    {
        $task = new self();
        return $task->get();
    }


}