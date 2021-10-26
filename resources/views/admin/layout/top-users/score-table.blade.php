<table id="dataTable" class="table table-hover">
    @include('admin.layout.top-users.header', ['headers' => $headers])
    <tbody>
    @foreach($data as $element)
        <tr>
            @include('admin.layout.top-users.user-row', ['user' => $element, 'iteration' => $loop->iteration, 'scoreName' => 'score_sum'])
        </tr>
    @endforeach
    </tbody>
</table>
