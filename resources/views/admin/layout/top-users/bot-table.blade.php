<table id="dataTable" class="table table-hover">
    @include('admin.layout.top-users.header', ['headers' => $headers])
    <tbody>
    @foreach($data as $element)
        <tr>
            @include('admin.layout.top-users.user-row', ['user' => $element, 'iteration' => $loop->iteration, 'scoreName' => 'lastWeekScore'])
            <td>
                <div class="open-case-block" id="case-count-{{$element->id}}">
                    <input value="1"/>
                    <button onclick="openRandomCase({{$element->id}}, '{{route('adminRandomCase')}}')">Открыть кейс
                    </button>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
