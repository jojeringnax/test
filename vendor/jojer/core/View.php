<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 15:31
 */

namespace jojer\core;


class View
{
    private static $_view;
    private static $layout;
    private $viewPath;
    private $attributes;

    private function __construct()
    {
    }

    public static function getView($layout)
    {
        if(self::$_view === null) {
            self::$_view = new self;
        }
        self::$layout = $layout === null ? APP_DIR.'views/layouts/normal.php' : $layout;
        return self::$_view;
    }

    public function render($folder, $view, $attributes = null)
    {
        if (!empty(ob_get_contents())) {
            ob_end_clean();
        }
        ob_start();
        $this->viewPath = APP_DIR.'views'.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$view.'.php';
        if (is_file($this->viewPath)){
            if(isset($attributes) && is_array($attributes)) {
                $this->attributes = $attributes;
                extract($attributes, EXTR_OVERWRITE);
            }
        }
        require self::$layout;
        include $this->viewPath;
    }
}