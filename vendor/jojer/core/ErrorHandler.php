<?php

namespace jojer\core;

class ErrorHandler
{

    public function register()
    {
        set_error_handler([$this, 'errorHandler']);
        register_shutdown_function([$this, 'fatalErrorHandler']);
        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline)
    {
        $this->showError($errno, $errstr, $errfile, $errline);

        return true;
    }

    public function fatalErrorHandler()
    {
        if ($error = error_get_last()) {
            ob_get_clean();
            $this->showError($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }

    public function exceptionHandler($exception)
    {
        $this->showError(get_class($exception), $exception->getMessage(), $exception->getFile(), $exception->getLine());
        return true;
    }

    public function showError($errno, $errstr, $errfile, $errline, $status = 500)
    {
        header("HTTP/1.1 {$status}");

        echo $errno . "<hr />" . $errstr . "<hr />" . $errfile . "<hr />" . $errline;
    }

}