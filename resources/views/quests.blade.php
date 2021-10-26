@extends('main')
@section('content')
    <main class="freegold">
        <div class="main__container">
            <p class="ttl48">{{trans('quests.title')}}</p>
        </div>
        <div class="freegold__line"></div>
        <div class="main__container">
            <p class="txt18">
                {{trans('quests.description', ['url' => trans('project_defs.url')])}}
            </p>

            <div class="freegold__container">

                {{--            <div class="freegold__left">--}}
                {{--                <div class="freegold__block">--}}
                {{--                    <p class="freegold__block_ttl">QUEST LOG</p>--}}
                {{--                    <div class="freegold__block_descr">--}}
                {{--                        <img src="/img/icons/crown01.svg" alt="" class="freegold__block_descr_icon">--}}
                {{--                        <p class="freegold__block_descr_ttl">Задания Tasty-Case</p>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="freegold__block">--}}
                {{--                    <p class="freegold__block_ttl">QUEST LOG</p>--}}
                {{--                    <div class="freegold__block_descr">--}}
                {{--                        <img src="/img/icons/crown01.svg" alt="" class="freegold__block_descr_icon">--}}
                {{--                        <p class="freegold__block_descr_ttl">Задания Tasty-Case</p>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="freegold__block">--}}
                {{--                    <p class="freegold__block_ttl">QUEST LOG</p>--}}
                {{--                    <div class="freegold__block_descr">--}}
                {{--                        <img src="/img/icons/crown01.svg" alt="" class="freegold__block_descr_icon">--}}
                {{--                        <p class="freegold__block_descr_ttl">Задания Tasty-Case</p>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--                <div class="freegold__block">--}}
                {{--                    <p class="freegold__block_ttl">QUEST LOG</p>--}}
                {{--                    <div class="freegold__block_descr">--}}
                {{--                        <img src="/img/icons/crown01.svg" alt="" class="freegold__block_descr_icon">--}}
                {{--                        <p class="freegold__block_descr_ttl">Задания Tasty-Case</p>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                {{--            </div>--}}

                @include('layout.quests.quest-list', ['quests' => $quests])

            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{url()->asset('js/quests.js')}}"></script>

    @guest
        <script src="{{url()->asset('js/auth-required.js')}}">
        </script>
    @endguest
@append

@section('modals')
    @foreach($quests as $quest)
        @include('layout.quests.popups.'.$quest->name);
    @endforeach
@endsection
