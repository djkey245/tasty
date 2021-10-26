<div class="payment__left">
    <p class="payment__left_ttl">PAYMENT</p>

    <div class="payment__left_list">
        @foreach($selectedTypes as $selectedType)
            <input
                class="payment__method_radio"
                type="radio"
                name="payment__method"
                id="{{$selectedType}}"
                @if($loop->first)
                checked
                @endif
            >
            <label class="payment__method" for="{{$selectedType}}">
                @switch($selectedType)
                    @case('g2a')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <div class="payment__method_str">
                        <img class="payment__method_g2a_icon" src="/img/payment/g2a.png" alt="">
                    </div>
                    <div class="payment__method_str">
                        <img class="payment__method_skrill_icon" src="/img/payment/skrill01.png" alt="">
                        <img class="payment__method_neteller_icon" src="/img/payment/neteller01.png" alt="">
                        <img class="payment__method_up_icon" src="/img/payment/up01.svg" alt="">
                        <img class="payment__method_bitcoin_icon" src="/img/payment/bitcoin01.png" alt="">
                    </div>
                    @break
                    @case('visa')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <img class="payment__method_visa_bigicon" src="/img/payment/visa01.png" alt="">
                    <p class="payment__method_txt">{{trans('blocks/layout/payment/types/visa.description')}}</p>

                    @break
                    @case('skins')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <div class="payment__method_center">
                        <img class="payment__method_knife_icon" src="/img/payment/knife01.svg" alt="">
                        <p class="payment__method_ttl">{{trans('blocks/layout/payment/types/skin.title')}}</p>
                    </div>

                    @break
                    @case('paymentwall')

                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <div class="payment__method_str">
                        <img src="/img/payment/pw01.png" alt="" class="payment__method_pw_icon">
                    </div>
                    <div class="payment__method_str">
                        <img class="payment__method_dg_icon" src="/img/payment/dg01.png" alt="">
                        <img class="payment__method_deal_icon" src="/img/payment/deal01.png" alt="">
                        <img class="payment__method_gp_icon" src="/img/payment/gp01.png" alt="">
                        <img class="payment__method_bitcoin_icon" src="/img/payment/bitcoin01.png" alt="">
                    </div>

                    @break
                    @case('paysafe')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <img class="payment__method_paysafe_icon" src="/img/payment/paysafe01.png" alt="">
                    <p class="payment__method_txt">
                        {{trans('blocks/layout/payment/types/skin.title')}}
                        </p>
                    @break
                    @case('paypal')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <img class="payment__method_paypal_icon" src="/img/payment/paypal01.png" alt="">
                    <p class="payment__method_txt">
                        {{trans('blocks/layout/payment/types/paypal.description')}}</p>

                    @break
                    @case('giftcard')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <div class="payment__method_str">
                        <img class="payment__method_gift_icon" src="/img/payment/gift01.svg" alt="">
                        <p class="payment__method_ttl">{{trans('blocks/layout/payment/types/giftcard.title')}}</p>
                        <img class="payment__method_visa_smallicon" src="/img/payment/visa02.png" alt="">
                    </div>
                    <p class="payment__method_txt">
                        {{trans('blocks/layout/payment/types/giftcard.description')}}
                    </p>

                    @break

                    @case('crypto')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <div class="payment__method_str">
                        <img class="payment__method_crypto_icon" src="/img/icons/bitcoin_logo01.png" alt="">
                        <p class="payment__method_ttl">{{trans('blocks/layout/payment/types/giftcard.title')}}</p>
                    </div>
                    <div class="payment__method_str">
                        <img class="payment__method_crypto_icon" src="/img/payment/eth01.svg" alt="">
                        <img class="payment__method_crypto_icon" src="/img/icons/bitcoin_logo01.png" alt="">
                        <img class="payment__method_crypto_icon" src="/img/payment/lt01.png" alt="">
                        <img class="payment__method_crypto_icon" src="/img/payment/t01.png" alt="">
                    </div>

                    @break

                    @case('unitpay')

                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <img class="payment__method_visa_bigicon" src="/img/payment/unitpay.png" alt="">
                    <p class="payment__method_txt">{{trans('blocks/layout/payment/types/giftcard.description')}}</p>


                    @break

                    @case('gamemoney')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <img class="payment__method_visa_bigicon" src="/img/payment/gamemoney.png" alt="">
                    <p class="payment__method_txt">{{trans('blocks/layout/payment/types/gamemoney.description')}}</p>
                    @break

                    @case('p24')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <img class="payment__method_visa_bigicon" src="/img/payment/prz.png" alt="">
                    <p class="payment__method_txt">{{trans('blocks/layout/payment/types/p24.description')}}</p>
                    @break

                    @case('paybylink')
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <img class="payment__method_visa_bigicon" src="/img/payment/pb.png" alt="">
                    <p class="payment__method_txt">{{trans('blocks/layout/payment/types/paybylink.description')}}</p>
                    @break

                    @default
                    <div class="payment__method_tick"><img class="payment__method_tick_img" src="/img/icons/tick01.svg"
                                                           alt=""></div>
                    <div class="payment__method_str">
                        <img class="payment__method_visa_bigicon" src="/img/payment/zen.png" alt="">
                        
                    </div>
                    <p class="payment__method_txt">Payments via ZEN will not be accepted in following countries: Belgium, China, Japan, The Netherlands and the Isle of Man, Taiwan, Thailand, Switzerland, Norway.</p>
                    @break



                @endswitch
            </label>
        @endforeach
    </div>
</div>
