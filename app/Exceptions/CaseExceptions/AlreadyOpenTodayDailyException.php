<?php

namespace App\Exceptions\CaseExceptions;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class AlreadyOpenTodayDailyException extends Exception
{


    public function report()
    {

    }

    public function render(Request $request)
    {
        return response()->json([
            'error' => trans("http/case.already_open_case_24", ["time" => $this->message])
        ]);
    }
}
