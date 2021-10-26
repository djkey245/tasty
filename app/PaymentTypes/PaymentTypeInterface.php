<?php


namespace App\PaymentTypes;


use App\Models\Payment;
use Illuminate\Http\Request;

interface PaymentTypeInterface
{
    /**
     * Return url redirect to payment
     *
     * @param Payment $payment
     * @return string
     */
    public function create(Payment $payment): string;



    public function callback(Request $request);
}
