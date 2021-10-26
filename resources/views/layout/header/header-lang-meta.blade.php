
@foreach($langs as $lang)
    <link rel="alternate" href="{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($lang)}}" hreflang="{{$lang}}"/>
@endforeach
