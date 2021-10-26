@extends('layout.main')
@section('content')


    <main class="topusers">

        <div class="main__container">

            <div class="topusers__header">
                <h1 class="ttl48">{{trans('top_users.title')}}</h1>
                <p class="txt18">{{trans('top_users.description')}}</p>
                @includeWhen($timerEnable, 'layout.top-users.timer', ['time' => $endWeekDiff])
            </div>

            @include('layout.top-users.dropdown', ['options' => $weekOptions, 'selectedValue' => $week])

            <div class="topusers__ttl">
                <p class="first">{{trans('top_users.in_top')}} <span>1%</span></p>
                <p class="second">{{trans('top_users.number_of_player')}} <span>{{$usersCount}}</span></p>
            </div>

            @include('layout.top-users.score-list', ['topUsers' => $topUserScore])

            <div class="topusers__regs">
                <div class="topusers__regs_cont">

                    @auth
                        @include('layout.top-users.user-score', ['score' => $userScore, 'name' => $userName])
                    @endauth
                    <div class="topusers__regs_block">
                        <p class="ttl21">{{trans('top_users.text_price')}}</p>
                        <div class="topusers__regs_subblock">
                            <div class="topusers__regs_subblock_img">
                                <img src="/img/gun02.svg" alt="gun tasty-case">
                            </div>
                            <p class="txt18">
                                {{trans('top_users.text_price_description')}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="topusers__ranges">
                <p class="ttl21"> {{trans('top_users.range_progress')}}</p>

                <div class="topusers__ranges_cont">
                    @foreach($ranks as $rank)
                        <div class="topusers__ranges_block">
                            <p class="topusers__ranges_quant">{{$rank->start_score}} / <span>{{$rank->end_score}}</span>
                            </p>
                            <img src="/storage/{{$rank->rank_img}}" alt="tasty-case ranks">
                            <p class="topusers__ranges_name">{{$rank->rank}}</p>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </main>

@endsection
