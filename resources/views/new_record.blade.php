@extends('templates.default')

@section('styles')
    #new_line_button:hover {
        cursor: pointer;
    }
@endsection

@section('content')
    <form method="POST" action='{{ route("record.new") }}' novalidate>
        @csrf
        <input type="hidden" id="count_row" name="count_row" value="{{ old('count_row') ? : 1 }}">
        <table class="table table-hover mt-4" id="main-table">
            <thead>
                <tr>
                    <th scope="col">Наименование</th>
                    <th scope="col" style="max-width: 30pt;">Ед. изм</th>
                    <th scope="col" style="max-width: 30pt;">Год</th>
                    <th scope="col">Количество</th>
                    <th scope="col">За единицу</th>
                    <th scope="col">Сумма</th>
                    <th scope="col">Объединение</th>
                    <th scope="col">Способ закупки</th>
                    <th scope="col">Дата поставки</th>
                    <th scope="col">КФО</th>
                    <th scope="col">КПС</th>
                    <th scope="col">КЭК</th>
                </tr>
            </thead>
            <tbody id="table-body">
                @for ($i = 1; $i <= (old('count_row') ? : 1); $i++)
                <tr>
                    <td class="" scope="row">
                        <input class="form-control {{ $errors->has('name_' . $i) ? 'is-invalid' : ''}}" type="text" name="name_{{$i}}" 
                            style="max-width: 90pt;" value="{{ Request::old('name_' . $i) ? : '' }}">
                    </td>
                    <td class="">
                        <select name="unit_{{$i}}" style="max-width: 70pt;" class="form-select" aria-label="Ед. измерения">
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    @if ($unit->id == old('unit_' . $i))
                                        selected="selected"
                                    @endif
                                >{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="align-middle">{{ date('Y') }}</td>
                    <td class="">
                        <input class="form-control {{ $errors->has('count_' . $i) ? 'is-invalid' : ''}}" id="count_{{$i}}" step='0.5' onChange="changeCount(this)" 
                                type="number" name="count_{{$i}}" style="max-width: 70pt;" value="{{ Request::old('count_' . $i) ? : '' }}">   
                    </td>
                    <td class="">
                        <input class="form-control {{ $errors->has('price_' . $i) ? 'is-invalid' : ''}}" id="price_{{$i}}" step='0.01' onChange="changePrice(this)" 
                            type="number" name="price_{{$i}}" style="max-width: 70pt;" value="{{ Request::old('price_' . $i) ? : '' }}">   
                    </td>
                    <td class="align-middle" style="width: 90pt;">
                        <input class="form-control" id="allCost_{{$i}} disabledInput" name="allCost_{{$i}}" type="number" placeholder="0.00" disabled>  
                    </td>
                    <td class="">
                        <input class="form-control {{ $errors->has('union_' . $i) ? 'is-invalid' : '' }}" type="text" name="union_{{$i}}" 
                            style="max-width: 80pt;" value="{{ Request::old('union_' . $i) ? : '' }}">   
                    </td>
                    <td class="">
                        <select name="way_{{$i}}" class="form-select" aria-label="Способ">
                            @foreach ($purchaseMethods as $purchaseMethod)
                                <option value="{{$purchaseMethod}}"
                                    @if ($purchaseMethod == old('way_' . $i))
                                            selected="selected"
                                    @endif
                                >{{$purchaseMethod}}</option>
                            @endforeach
                        </select>   
                    </td>
                    <td class="">
                        <input class="form-control {{ $errors->has('date_' . $i) ? 'is-invalid' : '' }}" type="date" name="date_{{$i}}" 
                            style="max-width: 120pt;" value="{{ Request::old('date_' . $i) ? : '' }}">   
                    </td>
                    <td class="">
                        <select name="cfo_{{$i}}" class="form-select" aria-label="Способ">
                            @foreach ($cfos as $cfo)
                                <option value="{{ $cfo->id }}"
                                    @if ($cfo->id == old('cfo_' . $i))
                                        selected="selected"
                                    @endif
                                >{{ $cfo->code }}</option>
                            @endforeach
                        </select>   
                    </td>
                    <td class="">
                        <input class="form-control {{ $errors->has('cps_' . $i) ? 'is-invalid' : '' }}" type="text" name="cps_{{$i}}" 
                            style="max-width: 30pt;" value="{{ Request::old('cps_' . $i) ? : '' }}">   
                    </td>
                    <td class="">
                        <input class="form-control {{ $errors->has('cec_' . $i) ? 'is-invalid' : '' }}" type="text" name="cec_{{$i}}" 
                            style="max-width: 30pt;" value="{{ Request::old('cec_' . $i) ? : '' }}">   
                    </td>
                </tr>
                @endfor
                <tr id="new_line_button_row">
                    <td class="text-center" scope="row" colspan='12' onclick="newLineClick(event)" id="new_line_button">Добавить еще одну строку</td>
                </tr>
            </tbody>
        </table>
        <div class="container mt-4 text-center">
            <button type="submit" class="btn btn-secondary me-4">Сохранить</button>
            <button onclick="window.location.href = '{{route('dashboard')}}'" id="cancelButton" type="button" class="btn btn-secondary">Отменить</button>
        </div>
    </form>
@endsection

@section('script')

    function newLineClick(evt){
        var countRow = document.getElementById('count_row');
        countRow.value = Number(countRow.value)+1;
        
        var tbodyRef = document.getElementById('table-body').insertRow(Number(countRow.value)-1);
        tbodyRef.insertCell().innerHTML = "<input class=\"form-control\" type=\"text\" name=\"name_" + String(countRow.value) + "\" style=\"max-width: 90pt;\">";
        
        tbodyRef.insertCell().innerHTML = "<select name=\"unit_" + String(countRow.value) + "\" style=\"max-width: 70pt;\" class=\"form-select\" aria-label=\"Ед. измерения\">@foreach ($units as $unit)<option value=\"{{ $unit->id }}\"@if ($unit->id == old('unit_' . $i))selected=\"selected\"@endif>{{ $unit->name }}</option>@endforeach</select>";
        
        var x = tbodyRef.insertCell();
        x.className = "align-middle";
        x.innerHTML = "{{ date('Y') }}";
        
        tbodyRef.insertCell().innerHTML = "<input class=\"form-control\" id=\"count_" + String(countRow.value) + "\" step=\'0.5\' onChange=\"changeCount(this)\" type=\"number\" name=\"count_" + String(countRow.value) + "\" style=\"max-width: 70pt;\">";
        
        tbodyRef.insertCell().innerHTML = "<input class=\"form-control\" id=\"price_" + String(countRow.value) + "\" step=\'0.01\' onChange=\"changePrice(this)\" type=\"number\" name=\"price_" + String(countRow.value) + "\" style=\"max-width: 70pt;\">";
        
        x = tbodyRef.insertCell();
        x.innerHTML = "<input class=\"form-control\" id=\"allCost_" + String(countRow.value) + " disabledInput\" name=\"allCost_" + String(countRow.value) + "\" type=\"number\" placeholder=\"0.00\" disabled>";
        x.className = "align-middle";
        x.style = "width: 90px;";   

        tbodyRef.insertCell().innerHTML = "<input class=\"form-control\" type=\"text\" name=\"union_" + String(countRow.value) + "\" style=\"max-width: 80pt;\">";

        tbodyRef.insertCell().innerHTML = "<select name=\"way_" + String(countRow.value) + "\" class=\"form-select\" aria-label=\"Способ\">@foreach ($purchaseMethods as $purchaseMethod)<option value=\"{{$purchaseMethod}}\"@if ($purchaseMethod == old('way_' . $i))selected=\"selected\"@endif>{{$purchaseMethod}}</option>@endforeach</select>";

        tbodyRef.insertCell().innerHTML = "<input class=\"form-control\" type=\"date\" name=\"date_" + String(countRow.value) + "\" style=\"max-width: 120pt;\">";

        tbodyRef.insertCell().innerHTML = "<select name=\"cfo_" + String(countRow.value) + "\" class=\"form-select\" aria-label=\"Способ\">@foreach ($cfos as $cfo)<option value=\"{{ $cfo->id }}\"@if ($cfo->id == old('cfo_' . $i))selected=\"selected\"@endif>{{ $cfo->code }}</option>@endforeach</select>";
        
        tbodyRef.insertCell().innerHTML = "<input class=\"form-control\" type=\"text\" name=\"cps_" + String(countRow.value) + "\" style=\"max-width: 30pt;\">";
 
        tbodyRef.insertCell().innerHTML = "<input class=\"form-control\" type=\"text\" name=\"cec_" + String(countRow.value) + "\" style=\"max-width: 30pt;\">";
    }

    function changePrice(evt){
        evt.value = Number(evt.value).toFixed(2);
        var lastChar = evt.id.substr(evt.id.length - 1);
        count_value = document.getElementById("count_" + lastChar).value;
        if(count_value){
            document.getElementById("allCost_" + lastChar + " disabledInput").value = (Number(evt.value) * Number(count_value)).toFixed(2);
        }
    }

    function changeCount(evt){
        evt.value = Number(evt.value).toFixed(5);
        var lastChar = evt.id.substr(evt.id.length - 1);
        price_value = document.getElementById("price_" + lastChar).value;
        if(price_value){
            document.getElementById("allCost_" + lastChar + " disabledInput").value = (Number(evt.value) * Number(price_value)).toFixed(2);
        }
    }

    function loadCost() {
        var count_row = Number(document.getElementById('count_row').value);
        for(var i = 1; i <= count_row; i++){
            var priceValue = document.getElementById("price_" + String(i)).value;
            var countValue = document.getElementById("count_" + String(i)).value;
            if(countValue && priceValue){
                document.getElementById("allCost_" + String(i) + " disabledInput").value = (Number(countValue) * Number(priceValue)).toFixed(2);
            }
        }
    }

    window.onload = loadCost;
@endsection