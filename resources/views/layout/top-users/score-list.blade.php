<ul class="topusers__list">

    <li class="topusers__list_string">
        <p class="topusers__list_string_number">#</p>
        <p class="topusers__list_string_ava"></p>
        <p class="topusers__list_string_name">{{trans("blocks/layout/top-users/score-list.player")}}</p>
        <p class="topusers__list_string_rate">{{trans("blocks/layout/top-users/score-list.rating")}}</p>
        <p class="topusers__list_string_prize">{{trans("blocks/layout/top-users/score-list.prize")}}</p>
    </li>

    @foreach($topUsers as $topUser)
        <li class="topusers__list_string">
            <p class="topusers__list_string_number">{{$loop->iteration}}</p>
            <div class="topusers__list_string_ava"><img src="{{$topUser->img}}" alt=""></div>
            <p class="topusers__list_string_name">{{$topUser->name}}</p>
            <p class="topusers__list_string_rate">{{$topUser->score_sum}}</p>
            @isset($prizes[$loop->iteration])
                <div class="topusers__list_string_prize">
                    @foreach($prizes[$loop->iteration] as $prize)
                        <img src="{{TCG\Voyager\Facades\Voyager::image($prize->item_image_url)}}" alt="">
                    @endforeach
                </div>
            @endisset
        </li>
    @endforeach

</ul>
