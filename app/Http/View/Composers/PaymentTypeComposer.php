<?php


namespace App\Http\View\Composers;


use App\Models\PaymentType;
use Illuminate\View\View;

class PaymentTypeComposer
{
    public function __construct()
    {
        $this->paymentTypeSlugs = PaymentType::activeSlugs();

    }

    public function compose(View $view)
    {
        $view->with('selectedTypes', $this->paymentTypeSlugs);
    }
}
