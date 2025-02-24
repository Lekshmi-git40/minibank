<?php

namespace App\Utils;

class ErrorMessage
{
    public $Error1;
    public $Error2;
    public $ResultOnNoErrors;

    public static function WithErrors(string $error1, string $error2=''):ErrorMessage
    {
        $errorMsg = new ErrorMessage();
        $errorMsg->Error1 = $error1;
        $errorMsg->Error2 = $error2;

        return $errorMsg;
    }

    public function HasError():bool
    {
        return !empty($this->Error1) || !empty($this->Error2);
    }

    public function errors():array
    {
        $Error1 = $this->Error1;
        $Error2 = $this->Error2;
        $All = compact('Error1', 'Error2');
        return compact('All');
    }
}
