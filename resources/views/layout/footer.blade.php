<!-- Subscription Form -->
 <style >.sp-force-hide { display: none;}.sp-form[sp-id="202030"] { display: block; background: #181b5b; padding: 15px; width: 100%; max-width: 100%; border-radius: 0px; font-family: Arial, "Helvetica Neue", sans-serif; background-repeat: no-repeat; background-position: center; background-size: auto;}.sp-form[sp-id="202030"] input[type="checkbox"] { display: inline-block; opacity: 1; visibility: visible;}.sp-form[sp-id="202030"] .sp-form-fields-wrapper { margin: 0 auto; width: 490px;}.sp-form[sp-id="202030"] .sp-form-control { background: #ffffff; border-color: rgba(55, 49, 176, 1); border-style: solid; border-width: 0px; font-size: 15px; padding-left: 8.75px; padding-right: 8.75px; border-radius: 25px; height: 35px; width: 100%;}.sp-form[sp-id="202030"] .sp-field label { color: #444444; font-size: 13px; font-style: normal; font-weight: bold;}.sp-form[sp-id="202030"] .sp-button-messengers { border-radius: 25px;}.sp-form[sp-id="202030"] .sp-button { border-radius: 25px; background-color: #6643f2; color: #ffffff; width: 100%; font-weight: 700; font-style: normal; font-family: Arial, sans-serif; box-shadow: none;}.sp-form[sp-id="202030"] .sp-button-container { text-align: center;}</style><div class="sp-form-outer sp-force-hide"><div id="sp-form-202030" sp-id="202030" sp-hash="6df5108b29282c091d60d813b6a6b4d15fce4921f0a2282f1a258956fa2bfbf4" sp-lang="en" class="sp-form sp-form-regular sp-form-embed sp-form-full-width" sp-show-options="%7B%22satellite%22%3Afalse%2C%22maDomain%22%3A%22login.sendpulse.com%22%2C%22formsDomain%22%3A%22forms.sendpulse.com%22%2C%22condition%22%3A%22onEnter%22%2C%22scrollTo%22%3A25%2C%22delay%22%3A10%2C%22repeat%22%3A3%2C%22background%22%3A%22rgba(0%2C%200%2C%200%2C%200.5)%22%2C%22position%22%3A%22bottom-right%22%2C%22animation%22%3A%22%22%2C%22hideOnMobile%22%3Afalse%2C%22urlFilter%22%3Afalse%2C%22urlFilterConditions%22%3A%5B%7B%22force%22%3A%22hide%22%2C%22clause%22%3A%22contains%22%2C%22token%22%3A%22%22%7D%5D%2C%22analytics%22%3A%7B%22ga%22%3A%7B%22eventLabel%22%3A%22%D0%A4%D0%BE%D1%80%D0%BC%D0%B0_%D0%BF%D0%BE%D0%B4%D0%BF%D0%B8%D1%81%D0%BA%D0%B8_%D0%9A%D0%BD%D0%B8%D0%B3%D0%B0_TASTY_CASE%22%2C%22send%22%3Afalse%7D%2C%22ym%22%3A%7B%22counterId%22%3Anull%2C%22eventLabel%22%3Anull%2C%22targetId%22%3Anull%2C%22send%22%3Afalse%7D%7D%2C%22utmEnable%22%3Afalse%7D"><div class="sp-form-fields-wrapper show-grid"><div class="sp-message"><div></div></div><form novalidate="" class="sp-element-container sp-lg sp-field-nolabel ui-droppable-hover show-grid"><div class="sp-field " sp-id="sp-a048b136-8705-4d5b-9801-68de4ebd425d"><label class="sp-control-label"><span >Email</span><strong >*</strong></label><input type="email" sp-type="email" name="sform[email]" class="sp-form-control " placeholder="tastycase@gmail.com" sp-tips="%7B%22required%22%3A%22Required%20field%22%2C%22wrong%22%3A%22Wrong%20email%22%7D" autocomplete="on" required="required"></div><div class="sp-field sp-button-container sp-lg" sp-id="sp-a9d7d538-bf59-4746-a0c7-97da2a23bd0a"><button id="sp-a9d7d538-bf59-4746-a0c7-97da2a23bd0a" class="sp-button">Subscribe &lt;3 </button></div></form><div class="sp-link-wrapper sp-brandname__left"></div></div></div></div><script type="text/javascript" async="async" src="//web.webformscr.com/apps/fc3/build/default-handler.js?1630912267696"></script> 
<!-- /Subscription Form -->
<footer class="footer">
    <div class="main__container">

        <div class="footer__inner">
            <div class="footer__col">
                <div class="footer__logo_box">
                    <p class="tastycase__logo">{!!trans('project_defs.logo_name')!!}</p>
                </div>
                <p class="footer__txt">2021 © {{trans('project_defs.name')}}<br>
                    Support: Instagram / ad@tasty-case.com
                    <br>
                    <br>
                    {!! trans('blocks/layout/footer.address') !!}
                </p>
            </div>
            {{menu('privacy-police','layout.footer.privacy-police')}}
            {{menu('urls', 'layout.footer.urls')}}
            {{menu('footer_cases', 'layout.footer.cases-menu')}}
        </div>
    </div>
</footer>

</body>

<script src="/js/jquery-3.5.1.js"></script>
<script src="/js/socket-io.js"></script>
<script src="/js/app.js"></script>
<script src="/js/moment.js"></script>

<script src="/js/slick.min.js"></script>
<script src="//web.webformscr.com/apps/fc3/build/loader.js" async sp-form-id="6df5108b29282c091d60d813b6a6b4d15fce4921f0a2282f1a258956fa2bfbf4"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="/js/main.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    Echo.channel('livedrop-tasty')
        .listen('.caseopened-on-tasty', (e) => {
            setTimeout(function () {
                if ($("#live__list").length) {
                    $("#live__list").prepend('' +
                        '            <div class="header__bottom_block ' + e.item.color + '">\n' +
                        '                <p class="header__bottom_ttl">' + e.item.title + '</p>\n' +
                        '                <img class="header__bottom_icon" src="' + e.item.img + '" alt="">\n' +
                        '                <img class="header__bottom_item" src="/img/item01.svg" alt="">\n' +
                        '            </div>\n');
                    /*
                                    '<a class="item-history item-ext" data-us="' + (e.item.hash ? e.item.hash : null) + '" data-id="' + e.item.id + '" style="display: inline; position: relative;">' +
                                    '<img class="item-history-pic" src="' + e.item.img + '" alt="' + e.item.img + '">' +
                                    '<div class="win-cases-title" style="display:none;">' + e.item.title + '</div>' +
                                    '<div class="rarity" style="background-color:#' + e.item.color + ';box-shadow: #e4ae39 0px 0px 32px 0.2px"></div>' +
                                    '<div class="history-weapon-hover">' +
                                    '<img src="' + e.item.img + '">' +
                                    '<b>' + e.item.title + '</b>' +
                                    '</div>' +
                                    '</a>');
                    */
                    // $(".win-cases__list a:last").remove();
                }
            }, e.pause);
        });
</script>
@yield('scripts')

    @yield('modals')
@include('layout.modals')
</html>
