@extends('layout.main')
@section('content')

    @php
        $readOnlyMode = isset($readOnly) && $readOnly;
    @endphp
    <main class="myacc">
        <div class="main__container">
            <p class="ttl48">{{$readOnlyMode?$user->name. " // ".trans('project_defs.url'):trans('blocks/account.my_account')}}</p>

            <div class="myacc__cont">

                <div class="myacc__left">

                    <div class="myacc__left_first blue__box">

                        <div class="myacc__left_avatar">
                            <img src="{{$user->img}}" alt="steam img logo" class="myacc__left_avatar_img">
                            <img src="/storage/{{$user->getRank()->rank_img}}" alt="rank tasty-case" class="myacc__left_avatar_rank">
                        </div>

                        <p class="ttl25">{{$user->name}}</p>

                        <div class="myacc__left_stats">
                            <div class="myacc__left_stats_info">
                                <p>{{$user->getRank()->rank}}</p>
                                <div class="myacc__left_stats_info_right">
                                    <p>{{$user->getRank()->level}}/{{$ranks->count()}}</p>
                                    <div class="myacc__left_stats_info_icon">
                                        <img src="/img/icons/quest01.svg" alt="quest tasty-case">

                                        {{--
                                                                                <div class="myacc__left_stats_info_notice">
                                                                                    <div class="myacc__left_stats_info_notice_string">
                                                                                        <p class="first"><span>Next rank:</span></p>
                                                                                        <p>{{$nextRank->rank}}</p>
                                                                                    </div>
                                                                                    <div class="myacc__left_stats_info_notice_string">
                                                                                        <p class="first"><span>Rank point:</span></p>
                                                                                        <p></p>
                                                                                    </div>
                                                                                </div>
                                        --}}
                                    </div>
                                </div>
                            </div>

                            <div class="myacc__left_stats_ind">
                                <div class="myacc__left_stats_ind_lvl"></div>
                            </div>
                        </div>

                        @if(!$readOnlyMode)
                        <div class="myacc__left_string first">
                            <p>{{trans('blocks/account.balance')}}</p>
                            <p>{{trans('project_defs.currency_sign')}} <span id="cabinet-balance">{{$user->modified_balance}}</span></p>

                            <a class="myacc__left_string_up" href="{{route('paymentShow')}}">+</a>
                        </div>
                        @endif
                        <div class="myacc__left_string second">
                            <p>{{trans('blocks/account.open')}}</p>
                            <p>{{$user->items()->count()}}</p>
                        </div>
                        {{--<div class="myacc__left_bonuses">
                            <p class="myacc__left_bonuses_txt">Бонусы будут <br> доступны через:</p>

                            <div class="myacc__left_bonuses_time">
                                <div class="myacc__left_bonuses_time_block">
                                    <p class="myacc__left_bonuses_time_digit">12</p>
                                    <p class="myacc__left_bonuses_time_txt">DAYS</p>
                                </div>
                                <div class="myacc__left_bonuses_time_block">
                                    <p class="myacc__left_bonuses_time_digit">:</p>
                                    <p class="myacc__left_bonuses_time_txt"></p>
                                </div>
                                <div class="myacc__left_bonuses_time_block">
                                    <p class="myacc__left_bonuses_time_digit">21</p>
                                    <p class="myacc__left_bonuses_time_txt">HOURS</p>
                                </div>
                                <div class="myacc__left_bonuses_time_block">
                                    <p class="myacc__left_bonuses_time_digit">:</p>
                                    <p class="myacc__left_bonuses_time_txt"></p>
                                </div>
                                <div class="myacc__left_bonuses_time_block">
                                    <p class="myacc__left_bonuses_time_digit">24</p>
                                    <p class="myacc__left_bonuses_time_txt">MINUTES</p>
                                </div>
                                <div class="myacc__left_bonuses_time_block">
                                    <p class="myacc__left_bonuses_time_digit">:</p>
                                    <p class="myacc__left_bonuses_time_txt"></p>
                                </div>
                                <div class="myacc__left_bonuses_time_block">
                                    <p class="myacc__left_bonuses_time_digit">19</p>
                                    <p class="myacc__left_bonuses_time_txt">SECONDS</p>
                                </div>
                            </div>
                        </div>--}}
                    </div>

                    {{--
                                        <div class="myacc__left_third blue__box">
                                            <p class="ttl21">YOU REFERAL</p>

                                            <div class="myacc__left_third_string">
                                                <div class="myacc__left_third_block">
                                                    <div>User:</div>
                                                    <p>1</p>
                                                </div>

                                                <div class="myacc__left_third_block">
                                                    <div>You have invested:</div>
                                                    <p>12</p>
                                                </div>

                                                <div class="myacc__left_third_block">
                                                    <div>Your profit:</div>
                                                    <p>$ <span>1.45</span></p>
                                                </div>
                                            </div>

                                        </div>
                    --}}

                </div>
                @if(!$readOnlyMode)
                    <div class="myacc__right">

                        @include('layout.account.trade')

                        @include('layout.account.promo')

                        {{--
                                            <div class="myacc__right_second blue__box">
                                                <p class="ttl21">REFERAL PROGRAM</p>
                                                <div class="myacc__right_second_string">
                                                    <div class="myacc__right_second_block">
                                                        <span>Users are invited:</span>
                                                        <p>0</p>
                                                    </div>
                                                    <div class="myacc__right_second_block">
                                                        <span>Your final arrived:</span>
                                                        <p>0</p>
                                                    </div>
                                                    <a href="#" class="myacc__right_second_btn">Open case</a>
                                                </div>
                                            </div>
                        --}}

                        {{--
                                            <div class="myacc__right_first">
                                                <p class="ttl21">YOUR REFERRAL LINK:</p>
                                                <div class="myacc__right_inputbox">
                                                    <input type="text" name="" placeholder="https://tasty-case.me/r/A0BB8D32E">
                                                    <button class="myacc__right_inputbox_icon">
                                                        <img src="/img/icons/copy01.svg" alt="">
                                                    </button>
                                                </div>
                                                <p class="txt18">
                                                    Share the link with your friends and get bonuses for <br> each replenishment.
                                                </p>
                                            </div>
                        --}}

                    </div>
                @endif

            </div>

            <div class="myacc__skins">
                <p class="ttl35">{{trans('blocks/account.my_skins')}}</p>
                @if(!$readOnlyMode)
                    <a href="/contract" class="myacc__skins_btn">{{trans('blocks/account.create_contract')}}</a>
                @endif

                <div class="skins__cont">

                    @php
                        $disabled = $readOnlyMode? 'disabled' : null
                    @endphp
                    @foreach($user->items->sortDesc() as $item)
                        @include('layout.skin-block.skin-block',
                                    [
                                        'status' => $disabled??$item->status,
                                        'item' => $item->item,
                                        'id' => $item->id
                                    ]
                                )
                    @endforeach

                </div>
            </div>

            @if(!$readOnlyMode)
                <div class="myacc__answers">
                    <p class="ttl35">{{trans('blocks/account.answer_to_questions')}}</p>

                    <div class="myacc__answers_cont">

                        @foreach($questions as $question)
                            <div class="myacc__answers_block">
                                <div class="myacc__answers_name">
                                    <img src="/img/icons/arrow02.svg" alt="">
                                    {{$question->question}}
                                </div>
                                <div class="myacc__answers_info">
                                    {{
                                    $question->answer
                                    }}
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            @endif
        </div>
    </main>

    @if(!$readOnlyMode)
        <script>
            function sendPromo() {
                let promo = $("#promocode").val();

                $.ajax({
                    method: "POST",
                    url: '/promo',
                    data: {
                        promo: promo
                    },
                    success: function (result) {
                        if (result.error) {
                            toastr.error(result.error, result.message ? result.message : '')
                        }
                        if (result.success) {
                            toastr.success(result.success, result.message ? result.message : '');
                        }
                    }
                });
                console.log(promo);
            }

            function saveLink() {
                let link = $('#link_o').val();
                $.ajax({
                    url: '/account/save-link',
                    method: 'post',
                    data: {
                        link_o: link
                    }
                }).done(function (res) {
                    console.log(res);
                    toastr.success(res.message, res.title);
                }).fail(function (err) {
                    console.log(err);
                    toastr.error(err.responseJSON.message, err.responseJSON.title);
                });
            }

            function openItem(item) {
                let id = item;
                let price = $('#item_' + item + ' .skin__price span').text();
                let color = $('#item_' + item + ' .color').text();
                let title = $('#item_' + item + ' .ttl16').html();
                let img = $('#item_' + item + ' .gun').attr('src');
                // title, img

                $("#sell-or-take").removeAttr('class');
                $("#sell-or-take").addClass('skinblock ' + color);

                $("#sell-or-take").html(
                    '            <img class="gun" src="' + img + '" alt="">\n' +
                    '            <img class="item" src="/img/item02.svg" alt="">\n' +
                    '            <p class="ttl"> ' + title + '</p>\n'
                );
                $('#cabinet-modal #sale-item span').html(price + '{{trans('project_defs.currency_sign')}}');

                $('#cabinet-modal #sale-item').attr('onclick', 'saleItem(' + id + ')');

                $('#cabinet-modal #take-item').attr('onclick', 'takeItem(' + id + ')');

                $("#cabinet-modal").fadeIn(300);

                $("body").addClass("blur");

                // console.log(item, price, color, title, img);
            }

            function openFirstItem(item) {
                let id = item;
                let price = $('#item_' + item + ' .skin__price span').text();
                let color = $('#item_' + item + ' .color').text();
                let title = $('#item_' + item + ' .ttl16').html();
                let img = $('#item_' + item + ' .gun').attr('src');
                // title,
                console.log(img);
                $("#item-img-big").attr('src', img);
                $("#item-img-small").attr('src', img);
                $(".skin_name").html(title);
                $("#cabinet_drop_price").html("&nbsp;" + price);
                console.log($("#cabinet_drop_price"));
                $(".first-case-item-first").attr('onclick', 'firstCase(' + id + ', 1)');
                $(".first-case-item-second").attr('onclick', 'firstCase(' + id + ', 2)');
                $(".first-case-item-third").attr('onclick', 'firstCase(' + id + ', 3)');


                $("#cabinet_modal_first_case").fadeIn(300);

                $("body").addClass("blur");

                // console.log(item, price, color, title, img);
            }

            function firstCase(id, number) {
                $.ajax({
                    type: "POST",
                    url: '/first-case/' + number,
                    data: {'item': id, 'locale': '{{app()->getLocale()}}'},
                    success: function (responce) {

                        if (responce.success) {
                            $('.header__top_account_balance span').html(responce.balance);
                            $('#cabinet-balance').html(responce.balance);
                            if (number == 1) {
                                toastr.success("{{trans('blocks/account.first_case_success_1')}}");
                            }
                            if (number == 2) {
                                toastr.success("{{trans('blocks/account.first_case_success_2')}}");
                            }
                            if (number == 3) {
                                toastr.success("{{trans('blocks/account.first_case_success_3')}}");
                            }
                            $("#item_" + id + " .header__item__block")
                                .html('<div class="skin__sold top__block">Sold</div>\n' +
                                    '                                    <div class="top__block_right">\n' +
                                    '                                        <button class="db"><img src="/img/icons/db01.svg" alt=""></button>\n' +
                                    '                                    </div>\n')

                            location.reload(true);
                        }
                        if (responce.warning) {
                            toastr.warning(responce.info, "{{trans('pages/cabinet.warning')}}");
                        }
                        if (responce.error) {
                            toastr.error(responce.error, "{{trans('pages/cabinet.error')}}");
                        }
                    }
                });
            }

            function saleItem(user_drop_id) {
                $.ajax({
                    type: "POST",
                    url: '/sale-item',
                    data: {'user_item': user_drop_id, locale: "{{app()->getLocale()}}"},
                    success: function (responce) {
                        if (responce.success) {
                            $("#item_" + user_drop_id + " .header__item__block")
                                .html('<div class="skin__sold top__block">Sold</div>\n' +
                                    '                                    <div class="top__block_right">\n' +
                                    '                                        <button class="db"><img src="/img/icons/db01.svg" alt=""></button>\n' +
                                    '                                    </div>\n')
                            $('.header__top_account_balance span').html(responce.balance);
                            $('#cabinet-balance').html(responce.balance);
                            toastr.success("{{trans('pages/cabinet.sold')}} " + responce.success.modified_price + "{{trans('project_defs.currency_sign')}}", "{{trans('pages/cabinet.ok')}}");
                        }
                        if (responce.warning) {
                            toastr.warning(responce.info, "{{trans('pages/cabinet.warning')}}");
                        }
                        if (responce.error) {
                            toastr.error(responce.error, "{{trans('pages/cabinet.error')}}");
                        }
                        $("#cabinet-modal").fadeOut(300);

                        $("body").removeClass("blur");


                    }
                });
            }

            function takeItem(user_drop_id) {
                $.ajax({
                    type: "POST",
                    url: '/take-item',
                    data: {'user_item': user_drop_id, locale:'{{app()->getLocale()}}'},
                    success: function (responce) {
                        console.log(responce);
                        if (responce.success) {
                            location.reload();
                        }
                        if (responce.warning) {
                            toastr.warning(responce.info, "{{trans('pages/cabinet.warning')}}");
                        }
                        if (responce.error) {
                            toastr.error(responce.error, "{{trans('pages/cabinet.error')}}");
                        }
                        $("#cabinet-modal").fadeOut(300);

                        $("body").removeClass("blur");


                    }
                });
            }


        </script>
    @endif

@endsection
@section("styles")
    @if($readOnlyMode)
        <style>
            .myacc__cont {
                justify-content: center;
            }
        </style>
    @endif
@append
