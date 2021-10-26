<div class="howitwork">
    <p class="ttl30">{{$title}}</p>
    <ul class="steps">
        @foreach($steps as $step)
            <li class="txt16">
                {{$loop->iteration}}. {{$step}}
            </li>
        @endforeach
    </ul>
</div>
