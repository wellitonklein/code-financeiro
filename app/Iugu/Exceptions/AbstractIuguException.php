<?php

namespace CodeFin\Iugu\Exceptions;
use Throwable;

/**
 * Created by PhpStorm.
 * User: tom
 * Date: 28/09/18
 * Time: 17:23
 */

class AbstractIuguException extends \Exception{
    private $errors;

    public function __construct($errors = null, $message = "", $code = 0, \Exception $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return null
     */
    public function getErrors()
    {
        return $this->errors;
    }


}