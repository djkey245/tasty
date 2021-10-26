<div class="payment__deposit_method_container">
    @foreach($values as $value)
        <input class="payment__deposit_radio" type="radio" name="payment__deposit_radio" id="{{$value}}_dollar" {{$loop->first?'checked': ''}}>
        <label class="payment__deposit_method" for="{{$value}}_dollar" onclick="setAmount({{$value}})">
            <p class="payment__deposit_method_sum">{{$value}}{{trans('project_defs.currency_sign')}}</p>
            <div class="payment__deposit_method_sub">
                <p class="payment__deposit_method_plus">+{{$value * $coinModifier}}</p>
                <img src="/img/icons/coin_01.svg" alt="" class="payment__deposit_method_icon">
            </div>
        </label>
    @endforeach
</div>
