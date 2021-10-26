<div class="skin__block {{$status === 'contract'?'item-0':''}} {{$item->color}}"
    {{isset($id)?"id=item_$id":""}}
>
    @if($status === 'contract')
        <div class="edit" onclick="addToContract({{$id}})">
            <div class="plus"></div>
            <p class="ttl16">{{trans('blocks/contract.addToContract')}}</p>
        </div>
    @endif

    <img class="gun" src="{{$item->img}}" alt="{{$item->title}}">
    <div style="display: none" class="color">{{$item->color}}</div>
    {{--                            <div class="take">Take it from store</div>--}}

    <div class="header__item__block">
        @switch($status)
            @case('wait')
            <div class="skin__price top__block" onclick="openItem({{$id}})">{{trans('project_defs.currency_sign')}}
                <span>{{$item->modified_price}}</span></div>

            <div class="top__block_right">

                <button class="dwnld ellipse" onclick="openItem({{$id}})"><img
                        src="/img/icons/dwnld01.svg" alt="Case CS:GO"></button>
            </div>
            @break
            @case('fcase')
            <div class="skin__price top__block" onclick="openFirstItem({{$id}})">{{trans('project_defs.currency_sign')}}
                <span>{{$item->modified_price}}</span></div>

            <div class="top__block_right">

                <button class="dwnld ellipse" onclick="openFirstItem({{$id}})"><img
                        src="/img/icons/dwnld01.svg" alt="Case CS:GO"></button>
            </div>
            @break
            @case('pay')
            <div class="skin__sold top__block">{{trans('blocks/layout/skin-block/status.pay')}}</div>

            <div class="top__block_right">

                <button class="db"><img src="/img/icons/db01.svg" alt="Case CS:GO"></button>
            </div>
            @break

            @case('process')
            <div class="skin__waiting top__block">{{trans('blocks/layout/skin-block/status.process')}}</div>

            <div class="top__block_right">
                <button class="upd ellipse"><img src="/img/icons/upd01.svg" alt="Case CS:GO"></button>
            </div>

            @break

            @case('sent')
            <div class="skin__waiting top__block">{{trans('blocks/layout/skin-block/status.sent')}}</div>

            <div class="top__block_right">
                <button class="db"><img src="/img/icons/db01.svg" alt="Case CS:GO"></button>
            </div>

            @break
            @case('contract')
            <div class="skin__price top__block" onclick="openItem({{$id}})">{{trans('project_defs.currency_sign')}}
                <span>{{$item->modified_price}}</span>
            </div>
            @break

        @endswitch
    </div>

    @include('layout.skin-block.name', ['name' => $item->translatedTitle])
</div>
