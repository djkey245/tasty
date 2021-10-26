<ul class="footer__col">
    @php
        $items = $items->translate(app()->getLocale());
    @endphp
    @foreach($items as $element)
        <a href="{{$element->url}}" class="footer__link">{{$element->title}}</a>
    @endforeach
</ul>
