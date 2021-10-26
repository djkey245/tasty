@php
    $coinModifier = $coinModifier ?? 20;
@endphp
<div class="payment__deposit">
    <p class="payment__right_ttl">{{trans('blocks/layout/payment/history/list_header.payment')}} {{trans('project_defs.url')}}</p>
    <div class="payment__deposit_info">{{trans('blocks/layout/payment/payment-deposite.header')}}</div>

    @include('layout.payment.money-block', ['values' => $sumBlocks, 'coinModifier' => $coinModifier ])

    <div class="payment__deposit_bottom">
        <div class="payment__deposit_block">
            <p class="payment__deposit_label">{{trans('blocks/layout/payment/payment-deposite.enter_label')}}</p>
            <input type="text" class="payment__deposit_inp" value="">
        </div>
        <div class="payment__deposit_block">
            <p class="payment__deposit_label">{{trans('blocks/layout/payment/payment-deposite.you_will_get')}}</p>
            <div class="payment__deposit_bonus">
                <p class="payment__deposit_bonus_sum"><span></span>{{trans('project_defs.currency_sign')}}</p>
                <p class="payment__deposit_bonus_plus">+ <span></span></p>
                <img src="/img/icons/coin_01.svg" alt="" class="payment__deposit_bonus_icon">
            </div>
        </div>
        <div class="payment__deposit_btn_wrap">
            <button class="payment__deposit_btn"
                    onclick="sendRequestToPay('{{app()->getLocale()}}')">{{trans('blocks/layout/payment/payment-deposite.accept')}}</button>
        </div>
    </div>
    @section('scripts')
        <script>
            setAmount({{$sumBlocks[0]??5}});
            coinModifier.set({{$coinModifier}})
            minValue.set(0.5)
        </script>
    @append
</div>
