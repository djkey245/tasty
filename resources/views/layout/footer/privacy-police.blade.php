<div class="footer__col">
    @php
        $items = $items->translate(app()->getLocale());
    @endphp
    @foreach($items as $element)
        <a href="{{$element->url}}">
            <p class="footer__txt">{{$element->title}}</p>
        </a>
    @endforeach
</div>
