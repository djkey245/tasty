{{--<div class="balancepopup">--}}
{{--    <div class="balancepopup__bg"></div>--}}
{{--    <div class="balancepopup__window">--}}
{{--        <img class="balancepopup__window_bg" src="/img/bg/balancepopup01.png" alt="">--}}

{{--        <div class="balancepopup__close"></div>--}}
{{--        <p class="ttl50">RECHARGE BALANCE</p>--}}
{{--        <div class="line"></div>--}}
{{--        <div class="string">--}}
{{--            <p>$ 100 - 5% <br> bonus</p>--}}
{{--            <p>$ 300 - 10% <br> bonus</p>--}}
{{--            <p>$ 500 - 10% <br> bonus</p>--}}
{{--        </div>--}}

{{--        <div class="inputbox">--}}
{{--            <span class="sum">$</span>--}}
{{--            <input class="sum" id="sum_field" name="sum_field" value="25"/>--}}
{{--            <!-- <input type="submit" value=""> -->--}}
{{--        </div>--}}
{{--        <div class="inputbox">--}}
{{--            <input class="sum" id="promo_field" name="promo_field" placeholder="Promo code"/>--}}

{{--            <!-- <input type="submit" value=""> -->--}}
{{--        </div>--}}

{{--        <p class="txt18">--}}
{{--            It is possible to replenish skins with the benefit <span>of 20%</span>--}}
{{--        </p>--}}
{{--        <div class="string">--}}
{{--            <button onclick="pay('unipay')">Cash by Unitpay</button>--}}

{{--        </div>--}}
{{--        <div class="string">--}}
{{--            <button onclick="pay('paymentwall')">Test cash by paymentwall</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <script>--}}
{{--        function pay(type) {--}}
{{--            let sum = $("#sum_field").val();--}}
{{--            let promo = $("#promo_field").val();--}}
{{--            if (!sum) {--}}
{{--                toastr.error('Enter sum');--}}
{{--                return;--}}
{{--            }--}}
{{--            $.ajax({--}}
{{--                method: "POST",--}}
{{--                url: `/payment/${type}`,--}}
{{--                data: {--}}
{{--                    promo: promo,--}}
{{--                    sum: sum,--}}
{{--                }, success: function (res) {--}}
{{--                    console.log(res);--}}


{{--                    location.href = res.href;--}}
{{--                    /*--}}
{{--                                        const form = $('form[name="gamemoney_send"]');--}}
{{--                                        form.find('input[name="amount"]').val(res.amount);--}}
{{--                                        form.find('input[name="signature"]').val(res.signature);--}}
{{--                                        form.find('input[name="project_invoice"]').val(res.project_invoice);--}}
{{--                                        form.find('input[name="project"]').val(res.project);--}}
{{--                                        form.submit();--}}
{{--                    */--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        function skinpay() {--}}
{{--            let promo = $("#promo_field").val();--}}

{{--            $.ajax({--}}
{{--                method: "POST",--}}
{{--                url: '/payment/skinpay',--}}
{{--                data: {--}}
{{--                    promo: promo,--}}
{{--                }, success: function (res) {--}}
{{--                    location.href = res;--}}
{{--                    console.log(res);--}}
{{--                }--}}
{{--            });--}}

{{--        }--}}

{{--    </script>--}}
{{--</div>--}}


<div class="spinpopup">
    <div class="spinpopup__bg"></div>
    <div class="spinpopup__window">
        <img class="spinpopup__window_bg" src="/img/bg/spinpopup01.png" alt="">

        <div class="spinpopup__close"></div>
        <p class="ttl50">YOU WON</p>

        <div class="line"></div>

        <img src="/img/spins/img.png" alt="" class="img">

        <p class="txt20"><span>+35% TO TOP&#8209;UP BALANCE</span></p>

        <p class="txt18">
            We did it ! Catch the promotional code by
            <span class="green">35%</span>
            to replenish the balance:
            <span class="white">H63DB88AG6</span>
        </p>

    </div>
</div>


<div class="contractpopup">
    <div class="contractpopup__bg"></div>
    <div class="contractpopup__window">
        <img class="contractpopup__window_bg" src="/img/bg/contractpopup01.png" alt="">

        <div class="contractpopup__close"></div>
        <p class="ttl50">{{trans('blocks/modals/contract.title')}}</p>
        <div class="line"></div>
        <ul class="txt18">
            {!! trans('blocks/modals/contract.description') !!}
        </ul>
    </div>
</div>

<div class="caspopup" id="case-nonauth">
    <div class="caspopup__bg"></div>
    <div class="caspopup__window">
        <img class="caspopup__window_bg" src="/img/bg/caspopup01.png" alt="">

        <div class="caspopup__close"></div>
        <p class="ttl65">{{trans('blocks/modals/casepopup.title')}}</p>
        <div class="line"></div>
        <div class="skinblock" id="win_field">
            <img class="gun" src="/img/gun03.svg" alt="">
            <img class="item" src="/img/item02.svg" alt="">
            <p class="ttl"><span>AWP</span> <br> Змеиная кожа</p>
        </div>
        <p class="ttl30">{{trans('blocks/modals/casepopup.steam_login')}}</p>
        <p class="txt18">
            {!!trans('blocks/modals/casepopup.description')!!}
        </p>
        <button onclick="location.href = '/auth/provider/steam'">{{trans('blocks/modals.steam_login_button')}}</button>
    </div>
</div>
<div class="caspopup-auth" id="cases-popup">
    <div class="caspopup__bg"></div>
    <div class="caspopup__window">
        <img class="caspopup__window_bg" src="/img/bg/caspopup01.png" alt="">

        <div class="caspopup__close"></div>
        <p class="ttl65">{{trans('blocks/modals/casepopup.title')}}</p>
        <div class="line"></div>
        <div class="skinblock" id="win_field_auth">
            <img class="gun" src="/img/gun03.svg" alt="">
            <img class="item" src="/img/item02.svg" alt="">
            <p class="ttl"><span>AWP</span> <br> Змеиная кожа</p>
        </div>
        {{--        <p class="ttl30">{{trans('blocks/modals.steam_login_button')}} and take IT</p>--}}
        <p class="txt18">
            {!!trans('blocks/modals/casepopup-auth.description')!!}
        </p>
        <div style="z-index: 90;">

            <button id="sale-item">{{trans('blocks/modals.sell')}} <span></span></button>
            <button id="case-modal-close">{{trans('blocks/modals.open_more')}}</button>
        </div>
    </div>
</div>

<div class="caspopup" id="cabinet-modal">
    <div class="caspopup__bg"></div>
    <div class="caspopup__window">
        <img class="caspopup__window_bg" src="/img/bg/caspopup01.png" alt="">

        <div class="caspopup__close"></div>
        <p class="ttl65">{{trans('blocks/modals/casepopup.title')}}</p>
        <div class="line"></div>
        <div class="skinblock" id="sell-or-take">
            <img class="gun" src="/img/gun03.svg" alt="">
            <img class="item" src="/img/item02.svg" alt="">
            <p class="ttl"><span>AWP</span> <br> Змеиная кожа</p>
        </div>
        {{--        <p class="ttl30">{{trans('blocks/modals.steam_login_button')}} and take IT</p>--}}
        <p class="txt18">
            {!!trans('blocks/modals/casepopup-auth.description')!!}
        </p>
        <div style="z-index: 90;">

            <button id="sale-item">{{trans('blocks/modals.sell')}} <span></span></button>
            <button id="take-item">{{trans('blocks/modals.pick_up')}}</button>
        </div>
    </div>
</div>


<div class="howpopup">
    <div class="howpopup__bg"></div>
    <div class="howpopup__window">
        <img class="howpopup__window_bg" src="/img/bg/howpopup01.png" alt="">

        <div class="howpopup__close"></div>
        <p class="ttl50">HOW DO YOU WANT <br> TO YOU</p>
        <div class="line"></div>

        <div class="string">
            <button onclick="pay('unipay')">Cash by Unitpay</button>

        </div>
        <div class="string">
            <button onclick="pay('paymentwall')">Test cash by paymentwall</button>
        </div>
    </div>
</div>


<div class="caspopup-auth" id="contract-popup">
    <div class="caspopup__bg"></div>
    <div class="caspopup__window">
        <img class="caspopup__window_bg" src="/img/bg/caspopup01.png" alt="">

        <div class="caspopup__close"></div>
        <p class="ttl65">YOU WON</p>
        <div class="line"></div>
        <div class="skinblock" id="win_field_contract">
            <img class="gun" src="/img/gun03.svg" alt="">
            <img class="item" src="/img/item02.svg" alt="">
            <p class="ttl"><span>AWP</span> <br> Змеиная кожа</p>
        </div>
        {{--        <p class="ttl30">{{trans('blocks/modals.steam_login_button')}} and take IT</p>--}}
        <p class="txt18">
            The item can be picked up
            in the profile
            <br>
            <span>within an hour.</span>
        </p>
        <div style="z-index: 90;">

            <button id="sale-item">{{trans('blocks/modals.sell')}} <span></span></button>
            <button id="case-modal-close">{{trans('blocks/modals.open_more')}}</button>
        </div>
    </div>
</div>

<div class="caspopup" id="first-case">
    <div class="caspopup__bg"></div>
    <div class="caspopup__window">
        <img class="caspopup__window_bg" src="/img/bg/caspopup01.png" alt="">

        <div class="caspopup__close"></div>
        <p class="ttl65">YOU WON</p>
        <div class="line"></div>
        <div class="skinblock" id="win_first_case">
            <img class="gun" src="/img/gun03.svg" alt="">
            <img class="item" src="/img/item02.svg" alt="">
            <p class="ttl"><span>AWP</span> <br> Змеиная кожа</p>
        </div>
        {{--        <p class="ttl30">{{trans('blocks/modals.steam_login_button')}} and take IT</p>--}}
        <p class="txt18">
            The item can be picked up
            in the <a href="{{route('account')}}">profile</a>
            <br>
            <span>within an hour.</span>
        </p>
    </div>
</div>


<div class="modal md-container md-effect-1 modal--win" id="cabinet_modal_first_case">
    <div class="modal__dialog">
        <div class="modal__dialog-bg"
             style="position: absolute; top:0; left: 0; width: 100%; height: 100%; z-index: 100;"></div>
        <div class="custom_modal modal__content" style="width:100%; height: auto;">
            <div class="inner" style="z-index: 101; position: relative;">
                <div class="caspopup__close"></div>

                <p class="title"> {{trans('blocks/modals/cabinet_modal_first_case.title')}} </p>

                <div class="items">
                    <div class="item">
                        <div class="image">
                            <img src="" alt="" style="max-width: inherit" id="item-img-big">
                        </div>

                        <p class="name">Top up your balance
                            <br>
                            for
                            <strong>1,3{{trans('project_defs.currency_sign')}}</strong>
                            and get
                        </p>
                        <div class="info">
                            <ul style="list-style-type: none; padding: 0;">
                                <li>
                                    <strong class="skin_name"></strong>
                                </li>
                                <li>0,25{{trans('project_defs.currency_sign')}} on balance</li>
                            </ul>
                        </div>

                        <div class="sub_image">
                            <img src="" alt="" style="max-width: inherit" id="item-img-small">
                        </div>
                        <div class="bottom">
                            <p>Save
                                <strong>0,4{{trans('project_defs.currency_sign')}}</strong>
                            </p>
                            <button
                                class="btn-first red first-case-item-first md-close">{{trans('blocks/modals/casepopup-auth.pick_up_item')}}</button>
                        </div>
                        <span class="decor"></span>

                    </div>
                    <div class="item">
                        <div class="image">
                            <img src="/img/column2.png" alt="" style="max-width: inherit">
                        </div>

                        <p class="name">Top up your balance
                            <br>
                            for
                            <strong>3,9{{trans('project_defs.currency_sign')}}</strong>
                            and get
                        </p>
                        <div class="info">
                            <ul style="list-style-type: none; padding: 0;">
                                <li>
                                    <strong class="skin_name"></strong>
                                </li>
                                <li>0,25{{trans('project_defs.currency_sign')}} on balance</li>
                                <li>Free opening of a <strong> MEDIUM QUALITY </strong> case from which you can get
                                    <strong> M4A1-S | Hyper Beast </strong>
                                    for <strong>20</strong>{{trans('project_defs.currency_sign')}}
                                </li>
                            </ul>
                        </div>

                        <div class="sub_image">
                            <img src="/img/column2.png" alt="" style="max-width: inherit" id="item-img-small">
                        </div>
                        <div class="bottom">
                            <p>Save
                                <strong>2.85{{trans('project_defs.currency_sign')}}</strong>
                            </p>
                            <button class="btn-first red first-case-item-second md-close">Pick up an item</button>
                        </div>
                        <span class="decor"></span>

                    </div>
                    <div class="item">
                        <div class="image">
                            <img src="/img/column3.png" alt="" style="max-width: inherit">
                        </div>

                        <p class="name">Top up your balance
                            <br>
                            for
                            <strong>13{{trans('project_defs.currency_sign')}}</strong>
                            and get
                        </p>
                        <div class="info">
                            <ul style="list-style-type: none; padding: 0;">
                                <li>
                                    <strong class="skin_name"></strong>
                                </li>
                                <li>0,25{{trans('project_defs.currency_sign')}} on balance</li>
                                <li>Free opening of a <strong> HIGH QUALITY </strong> case from which you can get
                                    <strong> AK-47 | Neon Revolution </strong>
                                    for <strong>20</strong>{{trans('project_defs.currency_sign')}}
                                </li>
                            </ul>
                        </div>

                        <div class="sub_image">
                            <img src="/img/column3.png" alt="" style="max-width: inherit" id="item-img-small">
                        </div>
                        <div class="bottom">
                            <p>Save
                                <strong>6.75{{trans('project_defs.currency_sign')}}</strong>
                            </p>
                            <button class="btn-first red first-case-item-third md-close">Pick up an item</button>
                        </div>
                        <span class="decor"></span>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>

<div id="auth-required" class="modal" style="display:none;">
    <div class="balancepopup__window">
        <p class="ttl21">{{trans('blocks/modals/auth-required.message')}}</p>
        <div class="string">
            <button onclick="location.href = '/auth/provider/steam'">{{trans('blocks/modals.steam_login_button')}}</button>
        </div>
    </div>

</div>

<script>
</script>
