<?php

namespace App\Exceptions\Task;

use Exception;

class TaskNotFoundException extends Exception
{
    protected $message = 'Задача не найдена';

    public function __construct(string $message = null) 
    {
        if ($message) {
            $this->message = $message;
        }

        parent::__construct($this->message);
    }
}
