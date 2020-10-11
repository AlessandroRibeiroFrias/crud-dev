<?php

namespace  App\Infrastructure\Connection;

class DBException extends \Exception
{
    public function __construct($message = null, $errorCode = 0)
    {
        $error = print_r(error_get_last());

        $newMessage = "\n{$message}";
        $newMessage .= "\nError: {$error}";

        parent::__construct($newMessage, $errorCode);
    }
}