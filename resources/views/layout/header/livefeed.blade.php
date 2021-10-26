<div class="header__bottom__live">
    <div class="header__bottom" id="live__list">
        @foreach($livefeed as $open_item)
            @if(!empty($open_item->item))
                <div class="header__bottom_block {{$open_item->item->color}}">
                    <p class="header__bottom_ttl">@include('layout.skin-block.name', ['name' => $open_item->item->title])</p>
                    {{--                <p class="header__bottom_subttl">1 sec over</p>--}}
                    <img class="header__bottom_icon" src="{{$open_item->item->img}}" alt="">
                    <img class="header__bottom_item" src="/img/item01.svg" alt="">
                </div>
            @endif
        @endforeach

    </div>
</div>
