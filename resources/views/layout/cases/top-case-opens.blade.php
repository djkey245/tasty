<div class="cas__cases">
    <h2 class="ttl35">{{trans('blocks/layout/cases/top-case-opens.header')}}</h2>
    <div class="skins__cont">
        @foreach($topCaseOpens as $caseOpen)
            @include('layout.skin-block.skin-block',
                        [
                            'status' => 'disabled',
                            'item' => $caseOpen->item
                        ]
                    )
        @endforeach

    </div>
</div>
