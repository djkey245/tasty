<ul class="footer__links">
    @php
        $items = $items->translate(app()->getLocale());
    @endphp
    @foreach($items as $element)
        <li>
            <a class="footer__link" href="{{$element->url}}">{{$element->title}}</a>
        </li>
    @endforeach
</ul>
