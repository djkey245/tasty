<ul class="header__top_list">

    @php
        $items = $items->translate(app()->getLocale());
    @endphp
    @foreach($items as $element)

        <li>
            <a class="header__top_link" href="{{$element->url}}">{{$element->title}}</a>
        </li>
    @endforeach
    {{--                        <li><a class="header__top_link orange" href="#">Balance bonus</a></li>--}}
    {{--                        <li><a class="header__top_link" href="#">Game</a></li>--}}
    {{--                        <li><a class="header__top_link" href="#">Inspect</a></li>--}}
    
    <li>
        @include('layout.header.lang-select')
    </li>
</ul>
