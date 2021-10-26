@extends('layout.main')
@section('content')
    <main class="contract" id="contract">

        <div class="contract__create">
            <div class="contract__container">
                <h1 class="ttl48">{{trans('blocks/contract.title')}}</h1>

                <div class="contract__create_cont" id="contract-area">

                    {{--
                                        <div class="skin__block rose">
                                            <div class="edit">
                                                <div class="minus"></div>
                                                <p class="ttl16">Delete</p>
                                            </div>

                                            <div class="skin__price top__block">$ <span>0.03</span></div>
                                            <img class="gun" src="/img/gun02.svg" alt="gun tasty-case">
                                            <p class="ttl16">AWP <br>
                                                <span>Змеиная кожа</span>
                                            </p>
                                        </div>
                    --}}
                    <div class="skin__block empty">
                        <div class="edit">
                            <div class="plus"></div>
                            <p class="ttl16">{{trans('blocks/contract.addToContract')}}</p>
                        </div>
                    </div>

                </div>

                <div class="contract__create_bottom">
                    <a class="txt16">{{trans('blocks/contract.how_its_works')}}</a>

                    <button onclick="sendContract()">
                        <p class="ttl21">{{trans('blocks/contract.create_contract')}}</p>
                        <p class="txt13">{{trans('blocks/contract.create_contract_tip')}}</p>
                    </button>
                </div>

            </div>
        </div>

        <div class="contract__items">

            <div class="main__container">
                <p class="ttl35">{{trans('blocks/contract.item_available')}}</p>

                <div class="contract__items_cont" id="items-area">

                    @foreach($items as $item)
                        @include('layout.skin-block.skin-block',
                                    [
                                        'status' => 'contract',
                                        'item' => $item->item,
                                        'id' => $item->id
                                    ]
                                )
                    @endforeach

                </div>
            </div>

        </div>
        @include('layout.how-it-work', ['title' => trans('blocks/contract.how_it_work_title'), 'steps' => [
                trans('blocks/contract.how_it_work_step_1'),
                trans('blocks/contract.how_it_work_step_2'),
                trans('blocks/contract.how_it_work_step_3', ['create_contract' => trans('blocks/contract.create_contract')]),
        ]])

    </main>





@endsection
@section('scripts')

    <script>
        var contract = [];

        function addToContract(id) {
            $('#item_' + id + ' .plus').removeClass('plus').addClass('minus');
            $('#item_' + id + ' .edit .ttl16').html('Delete');
            $('#item_' + id + ' .edit').attr('onclick', 'removeWithContract(' + id + ')');
            let item = $('#item_' + id);

            $('#contract-area .empty').hide();
            $('#contract-area').append(item);
            contract[id] = id;

        }

        function removeWithContract(id) {
            $('#item_' + id + ' .minus').removeClass('minus').addClass('plus');
            $('#item_' + id + ' .edit .ttl16').html('{{trans('blocks/contract/contract.addToContract')}}');
            $('#item_' + id + ' .edit').attr('onclick', 'addToContract(' + id + ')');
            let item = $('#item_' + id);

            let count = $('#contract-area .item-0').length;
            if (count == 1) {
                $('#contract-area .empty').show();
                $('#items-area').append(item);
            }
            $('#items-area').append(item);


            contract[id] = undefined;
            delete contract[id];

        }

        function sendContract() {
            let count = $('#contract-area .item-0').length;
            let items = contract.filter(onlyUnique);
            console.log(contract);
            if (count >= 3) {
                $.ajax({
                    method: 'POST',
                    url: '/contract',
                    data: {
                        items: items,
                        locale:'{{app()->getLocale()}}'
                    },
                    success: function (res) {
                        if (res.item) {
                            toastr.success('Success');

                            $("#contract-popup #sale-item span").html(res.item.modified.price + '');
                            $("#contract-popup #sale-item").attr('onclick', 'saleItem(' + res.user_item.id + ')');
                            $("#contract-popup #case-modal-close").attr('onclick', 'closePopup()');
                            $("#win_field_contract").removeAttr('class');
                            $("#win_field_contract").addClass('skinblock ' + res.item.color);
                            if (res.item.title.indexOf('|') !== -1) {

                                $("#win_field_contract").html(
                                    '            <img class="gun" src="' + res.item.img + '" alt="gun tasty-case">\n' +
                                    '            <img class="item" src="/img/item02.svg" alt="gun tasty-case">\n' +
                                    '            <p class="ttl"> <span>' + res.item.title.substring(0, res.item.title.indexOf('|')) + '</span>' +
                                    '                ' + res.item.title.substring((res.item.title.indexOf('|') + 1)) + '' +
                                    '            </p>\n'
                                );
                            } else {
                                $("#win_field_contract").html(
                                    '            <img class="gun" src="' + res.item.img + '" alt="gun tasty-case">\n' +
                                    '            <img class="item" src="/img/item02.svg" alt="gun tasty-case">\n' +
                                    '            <p class="ttl"> <span>' + res.item.title + '</span></p>\n'
                                );

                            }
                            $("#contract-popup").fadeIn(300);

                            $("body").addClass("blur");
                            $('#contract-area .empty').show();
                            $('#contract-area .item-0').remove();
                            contract = [];


                        }
                        if (res.error) {
                            toastr.error(res.error, '{{trans('pages/cabinet.error')}}')
                        }
                        console.log(res);
                    }
                })

            } else {
                toastr.warning('{{trans('http/contract.invalid_number_of_items')}}', '{{trans('pages/cabinet.warning')}}');
            }
        }

        function onlyUnique(value, index, self) {
            return self.indexOf(value) === index;
        }

        function saleItem(user_drop_id) {
            $.ajax({
                type: "POST",
                url: '/sale-item',
                data: {'user_item': user_drop_id, locale:'{{app()->getLocale()}}'},
                success: function (responce) {
                    if (responce.success) {
                        $('.header__top_account_balance span').html(responce.balance);
                        toastr.success("{{trans('pages/cabinet.sold')}} " + responce.success.modified_price + "{{trans('project_defs.currency_sign')}}", "{{trans('pages/cabinet.ok')}}");
                    }
                    if (responce.warning) {
                        toastr.warning(responce.info, "{{trans('pages/cabinet.warning')}}");
                    }
                    if (responce.error) {
                        toastr.error(responce.error, "{{trans('pages/cabinet.error')}}");
                    }
                    $("#contract-popup").fadeOut(300);

                    $("body").removeClass("blur");


                }
            });
        }

        function closePopup() {
            $("#contract-popup").fadeOut(300);

            $("body").removeClass("blur");

        }

    </script>
    @guest
        <script src="{{\Illuminate\Support\Facades\URL::asset('js/auth-required.js')}}">
        </script>
    @endguest
@endsection
