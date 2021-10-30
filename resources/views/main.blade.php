@extends('layout.main')
@section('content')

    <main class="main">


        @if(!empty($share))
            <div class="main__intro">
                <img src="/storage/{{$share->logo}}" alt="tasty-case">
                <p>{{$share->title}}</p>
            </div>

            <div class="main__first">
                <div class="main__container">
                    {{--                    <p class="ttl35">Time left: <span>{{$share->time_left}}</span></p>--}}

                    <div class="main__first_cont cont">
                        @foreach($share_category->activeLotcases as $share_case)

                            <a href="/cases/{{$share_case->slug}}" class="game__block">
                                <img src="/storage/{{$share_case->img}}" alt="{{$share_case->title}}">
                                <div class="game__price">$ <span>{{$share_case->modified_price}}</span></div>
                                <p class="game__name">{{$share_case->title}}</p>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>

        @endif

        @if(empty($seo_category) && !empty($categories))
            @foreach($categories as $category)
                <div class="main__second ">
                    <div class="main__container">
                        <h1 class="ttl35 case__main-title">{{$category->title}}</h1>

                        <div class="main__second_cont cont">
                            @foreach($category->activeLotcases->translate() as $lotcase)

                                <a href="/cases/{{$lotcase->slug}}" class="game__block">
                                    <img src="/storage/{{$lotcase->img}}" alt="{{$lotcase->title}}">
                                    <div class="game__price">{{trans('project_defs.currency_sign')}}
                                        <span>{{$lotcase->modified_price}}</span></div>
                                    <p class="game__name">{{$lotcase->title}}</p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endforeach
        @endif
        @if(!empty($seo_category) && empty($categories))
            <div class="main__second ">
                <div class="main__container">
                    <h2 class="ttl35 case__main-title">{{$seo_category->title}}</h2>

                    <div class="main__second_cont cont">
                        @foreach($seo_category->activeLotcases->translate() as $lotcase)

                            <a href="/cases/{{$lotcase->slug}}" class="game__block">
                                <img src="/storage/{{$lotcase->img}}" alt="{{$lotcase->title}}">
                                <div class="game__price">$ <span>{{$lotcase->modified_price, 2}}</span></div>
                                <p class="game__name">{{$lotcase->title}}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        @if(!empty($seo_pages))
            <div class="main__fourth">
                <div class="main__container">
                    <h3 class="ttl35">{{trans('blocks/menu.seo_title')}}</h3>

                    <div class="main__fourth_cont cont">
                        @foreach($seo_pages as $seo_page)
                            <a href="/page/{{$seo_page->slug}}" class="pack__block">{{$seo_page->title}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @include('layout.reviews.index')

        @include('layout.bottom-banner')
        <a class="wheel-href" href="/cases/first-case"><img src="/img/wheel1.png"></a>
    </main>



@endsection
@isset($messages)
@section('scripts')
    <script>
        const messages = JSON.parse('@json($messages)');
        for (let message of messages) {
            toastr.success(message.description, message.title)
        }
        @if($writeMessage)
        window.history.replaceState({}, document.title, "{{route('home')}}");
        @endif
    </script>
@append
@endif
