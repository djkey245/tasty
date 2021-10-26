<div class="panel panel-bordered">

    <div class="panel-body">

        <button type="button" class="btn btn-success" onclick="showModal()">Добавить Дроп</button>
        <button type="button" class="btn btn-success" onclick="updateAll()">Обновить все</button>
        @if(isset($dataTypeContent->id))
            <button type="button" class="btn btn-success check-value"
                    onclick="checkCase('{{route('checkValue', ['case' => $dataTypeContent->id])}}')">
                Оценить: $<span></span></button>
        @endif
        <input type="text" class="check-value-input" value="500"/>


        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-2">Class ID</div>
                <div class="col-xs-4">Title</div>
                <div class="col-xs-1">Price</div>
                <div class="col-xs-1">Active</div>
                <div class="col-xs-1">Exist</div>
                <div class="col-xs-3">Functions</div>
            </div>

            @foreach($dataTypeContent->items as $item)
                <div class="row drops">
                    <div class="col-xs-2"
                         style="background-color: {{$item->color}}; color: black">{{$item->class_id}}</div>
                    <div class="col-xs-4">{{$item->transaltedTitle}}</div>
                    <div class="col-xs-1">{{$item->price}}</div>
                    <div class="col-xs-1">
                        <input class="drops-active" type="checkbox"
                               {{$item->active ? 'checked' : ''}} name="active_{{$item->id}}"
                               data-drop_id="{{$item->id}}" id="active_{{$item->id}}">
                    </div>
                    <div class="col-xs-1">{{$item->exist}}</div>
                    <div class="col-xs-3">
                        <div class="icon col-xs-4">
                            <i class="voyager-refresh" onclick="updateDrop({{$item->id}})"></i>
                        </div>
                        <div class="icon col-xs-4">
                            <a href="{{$item->link}}">
                                <i class="voyager-download"></i>
                            </a>
                        </div>
                        <div class="icon col-xs-4">
                            <i class="voyager-x" onclick="deleteItem({{$item->id}})"></i>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


</div>
<style>
    .row.drops div {
        height: 30px;
    }

    .row.drops .icon {
        padding: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .row.drops .icon:hover {
        font-size: 18px;
    }
</style>
