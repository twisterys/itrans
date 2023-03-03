
<div class="col-md-12">
<table class="table table-striped" id="item_table">
    <thead class="item-table-header">
    <tr>
        <th width="1%"></th>
        <th width="10%">Type</th>
        <th width="10%" class="text-center">Matricule</th>
        <th width="1%">
            <span id="btn_add_row" class="btn btn-info btn-sm btn_add_row"><i class="fa fa-plus"></i></span>
        </th>
    </tr>
    </thead>
<tbody>
    @foreach (old('type_vehicle',$importVehicle ? $importVehicle->dossierVehicles : []) as $index => $oldVehicle)

    <tr class="item">
        <input type="hidden" name="IdVehicle[]" value="{{old('IdVehicle') ? old('IdVehicle')[$index] : ($importVehicle ? $oldVehicle->id : null) }}">
        <td><span class="btn btn-danger btn-sm btn-xs delete_row"><i class="fa fa-minus"></i><input type="hidden" name="item_id" id="item_id" value=""></span></td>
        <td>
            <div class="form-group">
                <select class="custom-select {{ $errors->has('type_vehicle') ? 'is-invalid' : '' }}" name="type_vehicle[]" id="type_vehicle" required>
                    @foreach($typeVehicle as $key => $label)
                        <option value="{{ $label->id }}" {{ (old('type_vehicle') ? old('type_vehicle')[$index] : ($importVehicle ? $oldVehicle->typeVehicle_id : ($importVehicle ? $oldVehicle->type_vehicle : '')))  == $label->id ? 'selected' : '' }}>{{ $label->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('type_vehicle'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type_vehicle') }}
                    </div>
                @endif
            </div>
        </td>
        <td>
            <div class="form-group">
                <input class="form-control matriculeVehicle {{ $errors->has('matriculeVehicle') ? 'is-invalid' : '' }}" type="text" name="matriculeVehicle[]" id="matriculeVehicle" value="{{ old('matriculeVehicle') ? old('matriculeVehicle')[$index] : ($importVehicle ? ($oldVehicle->matricule ? $oldVehicle->matricule : ($oldVehicle->vehicles ? $oldVehicle->vehicles->N_immatriculation : '')) : '') }}" required>
            </div>
        </td>
        <td></td>
    </tr>
    @endforeach
    </tbody>
</table>
</div>
<script>
    var availableMatricul ;
    availableMatricul = <?php echo (!empty($v) ?  $v : ''); ?>

    $(document).on('click', '.btn_add_row', function()
     {
        cloneRow('item_table');

        $('.matriculeVehicle').on("focus", function(){
            $(this).autocomplete({
                source: availableMatricul
            });
        });
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
            var strHtml1 = '<span class="btn btn-danger btn-sm btn-xs delete_row"><i class="fa fa-minus"></i><input type="hidden" name="item_id" id="item_id" value=""><input type="hidden" name="IdVehicle[]" value="{{ null }}"></span>';
            td1.innerHTML = strHtml1.replace(/!count!/g,count);

            var td3 = document.createElement("td");
            var strHtml3 = '<select class="custom-select {{ $errors->has('type_vehicle') ? 'is-invalid' : '' }}" name="type_vehicle[]" id="type_vehicle" required>      @foreach($typeVehicle as $key => $label)        <option value="{{ $label->id }}">{{ $label->name }}</option>    @endforeach</select></div>';
            td3.innerHTML = strHtml3.replace(/!count!/g,count);

             var td4 = document.createElement("td");
            var strHtml4 = '<input class="form-control matriculeVehicle {{ $errors->has('matriculeVehicle') ? 'is-invalid' : '' }}" type="text" name="matriculeVehicle[]" id="matriculeVehicle" value="" required>';
             td4.innerHTML = strHtml4.replace(/!count!/g,count);

             var td5 = document.createElement("td");
            var strHtml5 = '';
             td5.innerHTML = strHtml5.replace(/!count!/g,count);

            // append data to row
            row.appendChild(td1);

            row.appendChild(td3);

            row.appendChild(td4);

            row.appendChild(td5);

           // add to count variable
            count = parseInt(count) + 1;
            // append row to table
            tbody.appendChild(row);
            row.className = 'item';
    }

    $(document).ready(function() {
        $('.matriculeVehicle').on("focus", function(){
            $(this).autocomplete({
                source: availableMatricul
            });
        });
    });


    // function findMatricule(element){
    //     var typeSelected = $(element).val();
    //     console.log();
    //     $.ajax({
    //         url:'{{route('import.create')}}',
    //         type:'get',
    //         data: {type:typeSelected},

    //         success: function (response) {
    //             availableMatricul = response
    //         },
    //         error:function(err){
    //             console.log(err)
    //         }
    //     });
    //     console.log(availableMatricul)
    // }






</script>

