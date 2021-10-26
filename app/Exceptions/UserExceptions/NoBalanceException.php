<?php


namespace App\Exceptions\UserExceptions;


use Exception;
use Illuminate\Http\Request;

class NoBalanceException extends Exception
{
    public function report()
    {

    }

    public function render(Request $request)
    {
        return ["error" => trans("http/controller.no_balance")];
    }
}
