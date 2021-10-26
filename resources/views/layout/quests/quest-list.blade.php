<div class="freegold__right">

    @foreach($quests as $quest)
        <div class="freegold__task">
            <div class="freegold__task_left">
                <img src="{{$quest->iconUrl}}" alt="" class="freegold__task_icon">
                <div class="freegold__task_left_sub">
                    <p class="freegold__task_ttl">{{$quest->translatedTitle}}</p>
                    <div class="freegold__task_txt_cont">
                        <p class="freegold__task_txt">{{trans('blocks/layout/quests/quest-list.description')}}</p>
                        <div class="freegold__task_prize">

                            <p class="freegold__task_prize_sum">{{trans('project_defs.currency_sign')}}{{$quest->modifiedReward}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if($quest->alreadyDone)
                <div class="freegold__task_done">{{trans('blocks/layout/quests/quest-list.done')}}</div>
            @else
                <div class="freegold__task_start_wrap">
                    <button class="freegold__task_start" onclick="openQuestModal('{{$quest->name}}')">{{trans('blocks/layout/quests/quest-list.start')}}</button>
                </div>
            @endif

        </div>
    @endforeach

</div>
