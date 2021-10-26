<div class="header__middle_left">
    @isset($giveaway))

        <div class="giveaway__logo_box">
            <p class="giveaway__logo">{{$giveaway->name}}</p>
            @if(!empty($giveaway->icon))
                <img class="giveaway__icon" src="/storage/{{$giveaway->icon}}" alt="">
            @else
                <img class="giveaway__icon" src="/img/icons/giveaway01.svg" alt="">
            @endif
        </div>
        <div id="giveaway-date" style="display: none">{{$giveaway->end}}</div>
        <button onclick="window.open('{{$giveaway->link}}', '_blank');" id="giveaway-btn"
                class="header__middle_btn blue"></button>
        {{--
                            <div class="header__middle_sound">
                                <img class="header__middle_sound_icon" src="/img/icons/sound01.svg" alt="">
                                <p>Sound: <span>on</span></p>
                            </div>
        --}}
        {{--                    <button class="header__middle_btn yellow">76:52:12</button>--}}
    @endif

</div>
