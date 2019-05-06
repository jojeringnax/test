<?php
namespace app\models;

use jojer\core\Model;

/**
 * Class User
 * @package app\models
 */
class User extends Model {
    /**
     * @var string
     */
    public static $table = 'users';

    /**
     * @var array
     */
    public static $attributes = [
        'username',
        'email',
        'password',
        'admin'
    ];


}