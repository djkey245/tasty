<div class="payment__lastupd">
    <p class="payment__right_ttl">RECENT DEPOSITS</p>
    @if($payments->count()>0 )
        <div class="payment__lastupd_list_top">
            <p class="payment__lastupd_date">{{trans('blocks/layout/payment/history/list_header.date')}}</p>
            <p class="payment__lastupd_sum">{{trans('blocks/layout/payment/history/list_header.sum')}}</p>
            <p class="payment__lastupd_result">{{trans('blocks/layout/payment/history/list_header.result')}}</p>
            <p class="payment__lastupd_system">{{trans('blocks/layout/payment/history/list_header.payment')}}</p>
            <p class="payment__lastupd_id">{{trans('blocks/layout/payment/history/list_header.id')}}</p>
        </div>
    @endif

    <ul class="payment__lastupd_list">
        @forelse($payments as $payment)
            <li>
                <p class="payment__lastupd_date">{{$payment->short_created_at}}</p>
                <p class="payment__lastupd_sum">{{trans('project_defs.currency_sign')}}{{$payment->modified_converted_sum === 0 ? $payment->sum : $payment->modified_converted_sum}}</p>
                <p class="payment__lastupd_result {{$payment->status===1?'success': 'error'}}">{{$payment->visible_status}}</p>
                <p class="payment__lastupd_system">
                    <img class="payment__lastupd_system_img" src="/img/payment/cash01.png" alt="">
                    <span>Cash</span>
                </p>
                <p class="payment__lastupd_id">#{{$payment->id}}</p>
            </li>
        @empty
            <div class="payment__lastupd_list empty">
                <p class="payment__lastupd_empty">{{trans('blocks/layout/payment/history/list.empty_response')}}</p>
            </div>
        @endforelse
    </ul>
</div>
