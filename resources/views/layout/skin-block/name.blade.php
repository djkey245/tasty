@php
    $explodeName = explode('|', $name);
@endphp
@if($explodeName && !empty($explodeName[1]))
    <p class="ttl16">{{$explodeName[0]}} <br>
        <span>{{$explodeName[1]}}</span>
    </p>
@else
    <p class="ttl16">{{$name}}
    </p>
@endif
