<?php


namespace App\Exceptions\CaseExceptions;


use App\Models\Payment;
use Exception;
use Illuminate\Http\Request;

class MinPaymentSumRequiredException extends Exception
{
    public function report()
    {

    }

    public function render(Request $request)
    {
        return response()->json([
            "error" => trans(
                "http/controller.need_payment",
                ["payment" => Payment::minLocalePayment(), 'currency_sign' => trans("project_defs.currency_sign")]
            )
        ]);
    }
}
