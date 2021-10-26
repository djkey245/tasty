<div class="cas__cases main__first">
    <p class="ttl35">{{$title}}</p>

    <div class="skins__cont">
        <div class="main__second_cont cont">
            @foreach($lotcases->translate() as $lotcase)

                <a href="/cases/{{$lotcase->slug}}" class="game__block">
                    <img src="/storage/{{$lotcase->img}}" loading="lazy" alt="{{$lotcase->title}}">
                    <div class="game__price">{{trans('project_defs.currency_sign')}} <span>{{$lotcase->modified_price}}</span></div>
                    <p class="game__name">{{$lotcase->title}}</p>
                </a>
            @endforeach
        </div>
    </div>

</div>
