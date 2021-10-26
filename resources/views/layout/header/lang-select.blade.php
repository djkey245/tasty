@php

@endphp

<div class="language__picker_new">
    <div class="selected_lang lang">
        <span class="flag-icon {{$flags[$selectedLang]}}"></span> {{strtoupper($selectedLang)}} <span
            class="caret"></span>
    </div>
    <div class="available_langs">
        @foreach($langs as $lang)
            <a class="lang" href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($lang)}}">
                <span
                    class="flag-icon {{$flags[$lang]}}" {{$lang === $selectedLang? "selected" : ""}}
                ></span> {{strtoupper($lang)}}
            </a>
        @endforeach
    </div>
</div>
@section('scripts')
    <script src="{{asset('/js/lang-select.js')}}">

    </script>
@append

