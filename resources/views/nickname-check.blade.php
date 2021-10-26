@extends('layout.main')
@section('content')
    <main class="steambonus">
        

        <div class="main__container">

            <div class="steambonus__header">
                <h1 class="ttl48">{{trans('blocks/nickname-check.title')}}</h1>
                <p class="txt18">{{trans('blocks/nickname-check.description')}}</p>

                <div class="steambonus__block" id="check-button-block">
                    <button class="steambonus__btn"
                            onclick="checkNickname()" @if(isset($checkResult['buttonDisabled'])&&$checkResult['buttonDisabled']){{'disabled'}}@endif>
                        {{trans('blocks/nickname-check.check')}}
                    </button>
                    <div class="steambonus__subblock">
                        <p class="txt18">{{$checkResult['message']}}</p>
                    </div>
                </div>
            </div>
            @include('layout.how-it-work', [
                'steps' => [
                    trans('blocks/nickname-check.how_it_work_step_1', ['tasty-name' => trans('project_defs.url')]),
                    trans('blocks/nickname-check.how_it_work_step_2', ['check' => trans('blocks/nickname-check.check')]),
                    trans('blocks/nickname-check.how_it_work_step_3')
                 ],
                 'title' => trans('blocks/nickname-check.how_it_work_title')
                 ])
        </div>

        <div class="steambonus__slider">
            @foreach($daysArray as $day)
                @include('layout.count-money', ['day'=> $day, 'reward' => $day*$rewardPerClick])
            @endforeach
        </div>

    </main>
@endsection
@section('scripts')
    <script>
        function checkNickname() {
            $.ajax({
                method: "POST",
                url: '/nickname-check',
                data: {
                    activate: true,
                    locale: '{{app()->getLocale()}}'
                },
                success: function (result) {
                    document.querySelector('#check-button-block .steambonus__subblock p').innerText = result.message
                    document.querySelector('#check-button-block button').setAttribute('disable', result.buttonDisabled)
                }
            });
        }
    </script>
    @guest
        <script src="{{url()->asset('js/auth-required.js')}}">
        </script>
    @endguest
@endsection
