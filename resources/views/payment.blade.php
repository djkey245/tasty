@extends('layout.main')
@section('scripts')
    <script src="{{asset('js/payment/payment.js')}}">
    </script>
    <script src="{{asset('js/payment/filters.js')}}"></script>
@append

@section('content')
    <main class="payment">
        <div class="main__container">
            <div class="payment__container">

                @include('layout.payment.payment-types')

                <div class="payment__right">

                    @include('layout.payment.payment-deposite', ['sumBlocks' => $sumBlocks, 'coinModifier' =>$coinModifier])
                    @include('layout.payment.history.list', ['payments' => $userPayments])

                </div>

            </div>
        </div>
    </main>
@endsection
