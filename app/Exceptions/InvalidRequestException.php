<?php

namespace App\Exceptions;

use Exception;

class InvalidRequestException extends Exception
{
    public function __construct($message = "")
    {
        parent::__construct($message);
    }

    public function render()
    {
        $result = [
            'msg' => $this->message,
            'code' => 400,
            'data' => null
        ];

        return  response()->json($result, 400);
    }

}
