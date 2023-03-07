<div>
    <table class="table table-striped" id="item_table">
        <thead class="item-table-header">
        <tr>
            <th width="1%"></th>
            <th width="10%">Prestation</th>
            <th width="10%">Prix</th>
            <th width="10%">Commentaire</th>
            <th width="1%">
                <span id="btn_add_row" class="btn btn-info btn-sm btn_add_row"><i class="fa fa-plus"></i></span>
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach (old('services',$magasinageServices ? $magasinageServices : []) as $index => $oldService)
            <tr class="item">
                <input type="hidden" name="IdService[]" value="{{old('IdService') ? old('IdService')[$index] : ($magasinageServices ? $oldService->id : null) }}">

                <td><span class="btn btn-danger btn-sm btn-xs delete_row"><i class="fa fa-minus"></i><input type="hidden" name="item_id" id="item_id" value=""></span></td>
                <td>
                    <div class="form-group">
                        <select class="custom-select {{ $errors->has('services') ? 'is-invalid' : '' }}" name="services[]" id="services" required>
                            @foreach($services as $key => $label)
                                <option value="{{ $label->id }}" {{ (old('services') ? old('services')[$index] : ($magasinageServices ? $oldService->service->id : ($magasinageServices ? $oldService->service->name : '')))  == $label->id ? 'selected' : '' }}>{{ $label->name }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('services'))
                            <div class="invalid-feedback">
                                {{ $errors->first('services') }}
                            </div>
                        @endif
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input class="form-control price {{ $errors->has('price') ? 'is-invalid' : '' }}" type="text" name="price[]" id="price" value="{{ (old('price') ? old('price')[$index] : ($services ? ($oldService->price ? $oldService->price : '' ) : '') )}}">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input class="form-control comment {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment[]" id="comment" value="{{ (old('comment') ? old('comment')[$index] : ($services ? ($oldService->comment ? $oldService->comment : '' ) : '') )}}">
                    </div>
                </td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<script>
    $(document).on('click', '.btn_add_row', function()
    {
        cloneRow('item_table');

    });
    $(document).on('click', '.delete_row', function(){
        $(this).parents('tr').remove();
    });


    var count = "1";
    var c = 1;
    function cloneRow(in_tbl_name)
    {
        var tbody = document.getElementById(in_tbl_name).getElementsByTagName("tbody")[0];
        // create row
        var row = document.createElement("tr");
        // create table cell 1
        var td1 = document.createElement("td");
        var strHtml1 = '<span class="btn btn-danger btn-sm btn-xs delete_row"><i class="fa fa-minus"></i><input type="hidden" name="item_id" id="item_id" value=""><input type="hidden"  value="{{ null }}"></span>';
        td1.innerHTML = strHtml1.replace(/!count!/g,count);

        var td3 = document.createElement("td");
        var strHtml3 = '<select class="custom-select {{ $errors->has('service_id') ? 'is-invalid' : '' }}" name="service_id[]" id="service_id" required>      @foreach($services as $key => $label)        <option value="{{ $label->id }}">{{ $label->name }}</option>    @endforeach</select></div>';
        td3.innerHTML = strHtml3.replace(/!count!/g,count);

        var td4 = document.createElement("td");
        var strHtml4 = '<input type="hidden"  "><input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price[]" id="price" value="" step=0.01>';
        td4.innerHTML = strHtml4.replace(/!count!/g,count);

        var td5 = document.createElement("td");
        var strHtml5 = '<input type="hidden"  "><input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment[]" id="comment" value="">';
        td5.innerHTML = strHtml5.replace(/!count!/g,count);

        var td6 = document.createElement("td");
        var strHtml6 = '';
        td6.innerHTML = strHtml6.replace(/!count!/g,count);

        // append data to row
        row.appendChild(td1);

        row.appendChild(td3);

        row.appendChild(td4);

        row.appendChild(td5);

        row.appendChild(td6);


        // add to count variable
        count = parseInt(count) + 1;
        // append row to table
        tbody.appendChild(row);
        row.className = 'item';
    }

</script>
