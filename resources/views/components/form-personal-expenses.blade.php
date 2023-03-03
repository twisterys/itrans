<div class="col-md-12">
    <table class="table table-striped" id="item_table2">
        <thead class="item-table-header">
        <tr>
            <th width="2%"></th>
            <th width="20%" class="text-center">Type de frais</th>
            <th width="20%" class="text-center">Montant</th>
            <th width="20%" class="text-center">Devise</th>
            <th width="1%">
                <span id="btn_add_row" class="btn btn-info btn-sm btn_add_row2"><i class="fa fa-plus"></i></span>
            </th>
        </tr>
        </thead>
    <tbody>
        @foreach (old('type_frais',$personalExpense ? $personalExpense->personalExpenses : []) as $index => $oldPerso)
        <tr class="item">
            <input type="hidden" name="IdFrais[]" value="{{ old('IdFrais') ? old('IdFrais')[$index] : ($personalExpense ? $oldPerso->id : null) }} ">
            <td><span class="btn btn-danger btn-sm btn-xs delete_row2"><i class="fa fa-minus"></i><input type="hidden" name="item_id" id="item_id" value=""></span></td>
            <td>
                <div class="form-group">
                    <select class="custom-select {{ $errors->has('type_frais') ? 'is-invalid' : '' }}" name="type_frais[]" id="type_frais" required>
                        {{-- <option value selected disabled {{ old('type_frais', null) === null ? 'selected' : '' }}>Sélectionner SVP</option> --}}
                        @foreach($typeFrais as $key => $label)
                            <option value="{{ $label->id }}" {{ (old('type_frais') ? old('type_frais')[$index] : ($personalExpense ? $oldPerso->typeFrais_id : ''))  == $label->id ? 'selected' : '' }}>{{ $label->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type_frais'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type_frais') }}
                        </div>
                    @endif
                </div>
            </td>
            <td>
                <div class="form-group">
                        <input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="number" name="montant[]" id="montant" value="{{ old('montant') ? old('montant')[$index] : ($personalExpense ? $oldPerso->montant : '') }}" step=0.01>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="form-group">
                        <select class="custom-select {{ $errors->has('devise') ? 'is-invalid' : '' }}" name="devise[]" id="devise">
                            {{-- <option value="null" selected>Sélectionner SVP</option> --}}
                            @foreach(App\PersonalExpense::DEVISE as $key => $label)
                                <option value="{{ $key }}" {{ (old('devise') ? old('devise')[$index] : ($personalExpense ? $oldPerso->devise : ''))  === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('devise'))
                            <div class="invalid-feedback">
                                {{ $errors->first('devise') }}
                            </div>
                        @endif
                    </div>
                </div>
            </td>
            <td>
                
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>

    <script>

        $(document).on('click', '.btn_add_row2', function()
         {
            cloneRow2('item_table2');
         });
         $(document).on('click', '.delete_row2', function(){
              $(this).parents('tr').remove();
          });


        var count = "1";
        var c = 1;
        function cloneRow2(in_tbl_name)
        {
                var tbody = document.getElementById(in_tbl_name).getElementsByTagName("tbody")[0];
                // create row
                var row = document.createElement("tr");
                // create table cell 1
                var td1 = document.createElement("td");
                var strHtml1 = '<span class="btn btn-danger btn-sm btn-xs delete_row2"><i class="fa fa-minus"></i><input type="hidden" name="item_id" id="item_id" value=""></span>';
                td1.innerHTML = strHtml1.replace(/!count!/g,count);
                //add cell ref
                var td_ref = document.createElement("td");
                var strHtml_2 = '<select class="custom-select {{ $errors->has('type_frais') ? 'is-invalid' : '' }}" name="type_frais[]" id="type_frais">@foreach($typeFrais as $key => $label)<option value="{{ $label->id }}" >{{ $label->name }}</option>@endforeach</select>';
                td_ref.innerHTML = strHtml_2.replace(/!count!/g,count);
             //   create table cell 2
                var td3 = document.createElement("td");
                var strHtml3 = '<input type="hidden" name="IdFrais[]" value="{{ null }}"><input class="form-control {{ $errors->has('montant') ? 'is-invalid' : '' }}" type="number" name="montant[]" id="montant" value="" step=0.01>';
                 td3.innerHTML = strHtml3.replace(/!count!/g,count);



                 var td4 = document.createElement("td");
                var strHtml4 = '<select class="custom-select {{ $errors->has('devise') ? 'is-invalid' : '' }}" name="devise[]" id="devise">@foreach(App\PersonalExpense::DEVISE as $key => $label)<option value="{{ $key }}" >{{ $label }}</option>@endforeach</select>';
                 td4.innerHTML = strHtml4.replace(/!count!/g,count);

                 var td5 = document.createElement("td");
                var strHtml5 = '';
                 td5.innerHTML = strHtml5.replace(/!count!/g,count);



                // append data to row
                row.appendChild(td1);
                row.appendChild(td_ref);

                row.appendChild(td3);
                row.appendChild(td4);
                row.appendChild(td5);

               // add to count variable
                count = parseInt(count) + 1;
                c++;
                // append row to table
                tbody.appendChild(row);
                row.className = 'item';
        }

        $(document).ready(function() {

        });

    </script>



