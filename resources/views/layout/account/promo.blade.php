<div class="myacc__right_first">
    <p class="ttl21">{{trans('blocks/layout/account/promo.title')}}</p>
    <div class="myacc__right_inputbox">
        <input type="text" name="" id="promocode" placeholder="{{trans('project_defs.name')}}">
        <button class="myacc__right_inputbox_icon" onclick="sendPromo()">
            <img src="/img/icons/tick01.svg" alt="">
        </button>
    </div>
    <p class="txt18">
        {!!  trans('blocks/layout/account/promo.description', ['name' => trans('project_defs.name')])!!}</p>
    <a target="_blank"
       href="https://www.instagram.com/tasty_case/"
       class="green__link">
        <img src="/img/icons/link02.svg" alt="">



        <p>{{trans('blocks/layout/account/promo.instagram')}} {{trans('project_defs.name')}}</p>
    </a>


    <a target="_blank"
       href="https://forms.gle/LWWjBTwLUB1ovJVr7"
       class="green__link">
        <img src="/img/icons/link02.svg" alt="">

        

        <p>Rate our work ❤️</p>
    </a>
    {{--
                            <a href="#" class="green__link">
                                <img src="/img/icons/link02.svg" alt="">
                                <p>Click here to find your trade link.</p>
                            </a>
    --}}
</div>
