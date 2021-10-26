<div class="myacc__right_first">
    <p class="ttl21">{{trans('blocks/layout/account/trade.header')}}</p>
    <div class="myacc__right_inputbox">
        <input type="text" name="" id="link_o" value="{{$user->link_o}}"
               placeholder="https://steamcommunity.com/tradeoffer/new/?partner=YYYYYYYY&token=XX">
        <button class="myacc__right_inputbox_icon" onclick="saveLink()">
            <img src="/img/icons/tick01.svg" alt="">
        </button>
    </div>
    <p class="txt18">{{trans('blocks/layout/account/trade.description')}}
    </p>
    <a target="_blank"
       href="https://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url"
       class="green__link">
        <img src="/img/icons/link02.svg" alt="">
        <p>{{trans('blocks/layout/account/trade.link_message')}}</p>
    </a>
</div>
