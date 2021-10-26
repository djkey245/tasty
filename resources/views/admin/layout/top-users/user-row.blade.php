<td>
    {{$iteration}}
</td>
<td>
    {{$user->id}}
</td>
<td>
    <img height="35" src="{{$user->img}}" alt="{{$user->name}}">
</td>
<td>
    {{$user->name}}
</td>
<td>
    {{$user->$scoreName ?? 'score_sum'}}
</td>
