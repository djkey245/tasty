<div class="caspopup" id="email-quest">
    <div class="caspopup__window">

        <div class="caspopup__close"></div>
        <p class="ttl65">{{$quest->title}}</p>
        <div class="line"></div>
        <input type="text" class="payment__deposit_inp" id="quest-email-field" value="">

        <button onclick="sendEmail()">{{trans('blocks/layout/quests/popups/email-quest.send')}} <span></span></button>
    </div>
</div>
@section('scripts')
    <script src="{{asset('js/quests/email-quest.js')}}"></script>
@append
