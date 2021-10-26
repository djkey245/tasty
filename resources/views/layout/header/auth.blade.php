@php
    $user = $user??auth()->user();
@endphp

<div class="header__top_right">
    <a class="header__top_balance" href="{{route('paymentShow')}}"><span>+&nbsp;</span> {{trans('blocks/layout/header/auth.balance_up')}}</a>

    <div class="header__top_account">
        <img class="header__top_account_img" src="{{$user->img}}" alt="">

        <div class="header__top_account_right">
            <div class="header__top_account_string">
                <div class="header__top_account_substring">
                    <p class="header__top_account_name">{{$user->name}}</p>
                </div>
                <div class="header__top_account_secondsubstr">
                    <img class="header__top_account_rank"
                         src="/storage/{{$user->getRank()->rank_img}}" alt="">
                </div>
            </div>
            <div class="header__top_account_string">
                <div class="header__top_account_substring">
                    <p class="header__top_account_balance">{{trans('project_defs.currency_sign')}}
                        <span>{{$user->modified_balance}}</span></p>
                    <p class="header__top_account_health">
                        <span>{{$user->hearts}}</span>
                        <img src="/img/icons/heart01.svg" alt="">
                    </p>
                </div>
                <div class="header__top_account_secondsubstr">
                    <img class="header__top_account_arrow" src="/img/icons/arrow01.svg"
                         alt="">
                </div>
            </div>
        </div>

        <ul class="header__top_account_list" style="display: none;">
            <li><img src="/img/icons/account01.svg" alt=""> <a href="{{route('account')}}">{{trans('blocks/layout/header/auth.my_account')}}</a></li>
            <li><img src="/img/icons/out01.svg" alt=""> <a href="{{route('auth.logout')}}">{{trans('blocks/layout/header/auth.log_out')}}</a></li>
        </ul>

    </div>


</div>
