<?php


namespace App\Exceptions\CaseExceptions;


use Exception;
use Illuminate\Http\Request;

class FirstCaseOpenOnlyException extends Exception
{
    public function report()
    {

    }

    public function render(Request $request)
    {
        return response()->json(['message' => trans('http/case.first_open_only')], 400);
    }
}
