<?php

namespace App\Exceptions\CaseExceptions;

use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class MinPaymentSumForDailyException extends Exception
{
    public function report()
    {

    }

    public function render(Request $request)
    {
        return response()->json([
            'error' => trans(
                "http/case.required_payment_for_case_24",
                ["payment" => Payment::minLocalePayment(), 'currency_sign' => trans("project_defs.currency_sign")]
            )
        ]);
    }
    //
}
