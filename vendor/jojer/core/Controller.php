<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 14:27
 */

namespace jojer\core;

/**
 * Class Controller
 * @package jojer\core
 */
class Controller
{

    /**
     * @var string
     */
    protected $layout;


    /**
     * @param $folder
     * @param $view
     * @param array $attributes
     */
    public function render($folder, $view, $attributes=[])
    {
        View::getView($this->layout)->render($folder, $view, $attributes);
    }

}