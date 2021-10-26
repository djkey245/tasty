<div class="topusers__choices">
    <p class="ttl35">Choose a week:</p>
    <div class="topusers__choices_right">
        <img class="topusers__choices_calendar" src="/img/icons/calendar01.svg" alt="">

        <select class="topusers__choices_selector">
            @foreach($options as $option)
                <option
                    value="{{$option['value']}}"
                    @if($selectedValue === $option['value'])
                    selected
                    disabled
                    @endif
                >
                    {{$option['text']}}</option>
            @endforeach
        </select>
    </div>
</div>
