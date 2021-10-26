<div class="header__middle_right">

    @isset($stat)
        <div class="header__middle_stat">
            <img class="header__middle_stat_icon" src="/img/icons/stat01.svg" alt="Case Opened Stats">
            <div class="header__middle_stat_block">
                <p class="header__middle_stat_digit opened_case_count" id="case_open_count">{{$stat->case_opened}}</p>
                <p class="header__middle_stat_info">{{trans('blocks/layout/header/stat.case_opened')}}</p>
            </div>
        </div>

        <div class="header__middle_stat">
            <img class="header__middle_stat_icon" src="/img/icons/stat02.svg" alt="Contracts stats">
            <div class="header__middle_stat_block">
                <p class="header__middle_stat_digit contract_count">{{$stat->contracts}}</p>
                <p class="header__middle_stat_info">{{trans('blocks/layout/header/stat.contracts')}}</p>
            </div>
        </div>



        {{--
        <div class="header__middle_stat">
            <img class="header__middle_stat_icon" src="/img/icons/stat06.svg" alt="Users today">
            <div class="header__middle_stat_block">
                <p class="header__middle_stat_digit user_count">{{$stat->user_count_today}}</p>
                <p class="header__middle_stat_info">{{trans('blocks/layout/header/stat.user_count_today')}}</p>
            </div>
        </div>
        --}}

        {{--
                            <div class="header__middle_stat">
                                <img class="header__middle_stat_icon" src="/img/icons/stat03.svg" alt="">
                                <div class="header__middle_stat_block">
                                    <p class="header__middle_stat_digit">535 124</p>
                                    <p class="header__middle_stat_info">Upgrade</p>
                                </div>
                            </div>
        --}}

        {{--
                            <div class="header__middle_stat">
                                <img class="header__middle_stat_icon" src="/img/icons/stat04.svg" alt="">
                                <div class="header__middle_stat_block">
                                    <p class="header__middle_stat_digit">55 124</p>
                                    <p class="header__middle_stat_info">Сражений</p>
                                </div>
                            </div>
        --}}


        <div class="header__middle_stat">
            <img class="header__middle_stat_icon" src="/img/icons/stat05.svg" alt="Users total">
            <div class="header__middle_stat_block">
                <p class="header__middle_stat_digit user_count">{{$stat->user_count}}</p>
                <p class="header__middle_stat_info">{{trans('blocks/layout/header/stat.users')}}</p>
            </div>
        </div>
    @endisset
    @section('scripts')
        <script src="{{asset('js/stat-add.js')}}"></script>
        <script>
            startListen()
        </script>
    @append
</div>
