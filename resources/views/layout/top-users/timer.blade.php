<div class="topusers__header_block">
    <p class="ttl16">{{trans('blocks/layout/top-users/timer.to_the_end')}}</p>
    <div class="topusers__header_block_timer">

        <div class="topusers__header_block_timer_block">
            <p class="topusers__header_block_timer_digit days" value="{{$time->d}}" >{{$time->d}}</p>
            <p class="topusers__header_block_timer_txt">{{trans('blocks/layout/top-users/timer.days')}}</p>
        </div>

        <div class="topusers__header_block_timer_block">
            <p class="topusers__header_block_timer_digit">:</p>
            <p class="topusers__header_block_timer_txt"></p>
        </div>

        <div class="topusers__header_block_timer_block">
            <p class="topusers__header_block_timer_digit hours" value="{{$time->h}}" >{{$time->h}}</p>
            <p class="topusers__header_block_timer_txt">{{trans('blocks/layout/top-users/timer.hours')}}</p>
        </div>

        <div class="topusers__header_block_timer_block">
            <p class="topusers__header_block_timer_digit">:</p>
            <p class="topusers__header_block_timer_txt"></p>
        </div>

        <div class="topusers__header_block_timer_block">
            <p class="topusers__header_block_timer_digit minutes" value="{{$time->i}}" >{{$time->i}}</p>
            <p class="topusers__header_block_timer_txt">{{trans('blocks/layout/top-users/timer.minutes')}}</p>
        </div>

        <div class="topusers__header_block_timer_block">
            <p class="topusers__header_block_timer_digit">:</p>
            <p class="topusers__header_block_timer_txt"></p>
        </div>

        <div class="topusers__header_block_timer_block">
            <p class="topusers__header_block_timer_digit seconds" value="{{$time->s}}" >{{$time->s}}</p>
            <p class="topusers__header_block_timer_txt">{{trans('blocks/layout/top-users/timer.seconds')}}</p>
        </div>

    </div>
</div>
@section('scripts')
    <script src="{{asset('js/timer.js')}}"></script>
    <script>
        onTimer()
    </script>
@append
