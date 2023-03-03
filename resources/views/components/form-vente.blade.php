<div class="col-12">
    <div class="mb-3"><h1 style="margin:0">Vente</h1></div>
    <div class="row">
      <div class="form-group col-md-6" >
          <label class="required" for="client_id">Clients</label>
          <div class="input-group colorpicker-default" title="Using format option">
              <select class="form-control select2 input-lg{{ $errors->has('client_id') ? 'is-invalid' : '' }}" name="client_id" id="client_id" style="width: 100%;" required>
                <option value disabled {{ old('client_id', null) === null ? 'selected' : '' }}>Selectionner SVP</option>
                  @foreach($clients as $key => $value)
                      <option value="{{ $value->id }}" {{ old('client_id',$vente ? $vente->client->id : '') == $value->id ? 'selected' : '' }}>{{ $value->nom }}</option>
                  @endforeach
              </select>
          </div>

          @if($errors->has('client_id'))
              <div class="invalid-feedback">
                  {{ $errors->first('client_id') }}
              </div>
          @endif
          <span class="help-block"></span>
      </div>
      <div class="form-group col-md-3">
          <label for="invoice_date">Date</label>
          <input class="form-control date {{ $errors->has('vente_date') ? 'is-invalid' : '' }}" type="date" name="vente_date" id="vente_date" value="{{ old('vente_date',$vente ? $vente->vente_date : '') }}" placeholder="jj/mm/aaaa" required>
          @if($errors->has('vente_date'))
              <div class="invalid-feedback">
                  {{ $errors->first('vente_date') }}
              </div>
          @endif
          <span class="help-block"></span>
      </div>
        <div class="form-group col-md-3">
          <label for="echeance_date">Date d'échéance </label>
          <input class="form-control date {{ $errors->has('echeance_date') ? 'is-invalid' : '' }}" type="date" name="echeance_date" id="echeance_date" value="{{ old('echeance_date',$vente ? $vente->echeance_date : '') }}" placeholder="jj/mm/aaaa" required>
          @if($errors->has('echeance_date'))
              <div class="invalid-feedback">
                  {{ $errors->first('echeance_date') }}
              </div>
          @endif
          <span class="help-block"></span>
      </div>
  <div class="form-group col-md-6">
      <label class="required">Statut de paiement</label>
      <select class="form-control {{ $errors->has('paiement_statut') ? 'is-invalid' : '' }}" name="paiement_statut" id="pay_status" required>
          <option value disabled {{ old('pay_status', null) === null ? 'selected' : '' }}>Selectionner SVP</option>
          @foreach(App\Vente::PAY_STATUS_SELECT as $key => $label)
            <option value="{{ $key }}" {{ (old('paiement_statut') ? old('paiement_statut') : $vente->paiement_statut ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
          @endforeach
      </select>
      @if($errors->has('paiement_statut'))
          <div class="invalid-feedback">
              {{ $errors->first('paiement_statut') }}
          </div>
      @endif
      <span class="help-block"></span>
  </div>
  @if ($vente)

  <div class="form-group col-md-6">
    <label for="reference">Reference</label>
    <input class="form-control date {{ $errors->has('reference') ? 'is-invalid' : '' }}" type="text" name="reference" id="reference" value="{{ old('reference',$vente ? $vente->reference : '') }}">
    @if($errors->has('reference'))
        <div class="invalid-feedback">
            {{ $errors->first('reference') }}
        </div>
    @endif
    <span class="help-block"></span>
  </div>

  
  @endif
  <div class="form-group col-md-6">
    <label class="required" for="shema_id">Schema</label>
    <div class="input-group colorpicker-default" title="Using format option">
        <select class="form-control select2 input-lg{{ $errors->has('shema_id') ? 'is-invalid' : '' }}" name="shema_id" id="shema_id" style="width: 100%;" required>
          <option value disabled {{ old('shema_id', null) === null ? 'selected' : '' }}>Selectionner SVP</option>
            @foreach($shemas as $key => $value)
                <option value="{{ $value->id }}" {{ old('shema_id',$vente ? $vente->schema->id : '') == $value->id ? 'selected' : '' }}>{{ $value->nom }}</option>
            @endforeach
        </select>
    </div>
    @if($errors->has('shema_id'))
        <div class="invalid-feedback">
            {{ $errors->first('shema_id') }}
        </div>
    @endif
    <span class="help-block"></span>
  </div>
</div>
<div class="col-md-12">
  <table class="table table-striped" id="item_table">
      <thead class="item-table-header">
      <tr>
          <th width="5%"></th>
          <th width="20%">Produit</th>
          <th width="35%">Description</th>
          <th width="10%" class="text-center">Quantite</th>
          <th width="10%" class="text-center">Prix</th>
          <th width="10%" class="text-center">Tax</th>
          <th width="10%"class="text-right">Montant HT</th>
      </tr>
      </thead>
      <tbody>
        @foreach (old('item_name',$vente ? ($vente->venteitems ? $vente->venteitems : [])  : []) as $index => $oldventeItem)
          <tr class="item">
              <td>
                <button class="btn btn-danger delete_row" type="button"><i class="fa fa-trash"></i></button>
                <input type="hidden" name="item_id[]" value="{{(old('item_id') ? old('item_id')[$index] : ($vente->venteitems ? $oldventeItem->id : '') )}}">
              </td>
              <td><div class="form-group">{!! Form::text('item_name[]',(old('item_name') ? old('item_name')[$index] : ($vente->venteitems ? $oldventeItem->nom : '') ),['class' => 'form-control input-sm item_name', 'id'=>"item_name" , 'required']) !!}</div></td>
              <td><div class="form-group">{!! Form::textarea('item_description[]',(old('item_description') ? old('item_description')[$index] : ($vente->venteitems ? $oldventeItem->description : '') ),['class' => 'form-control item_description input-sm','id'=>"item_description",'rows'=>'1','style'=>'resize: vertical;text-transform: capitalize;']) !!}</div></td>
              <td><div class="form-group">{!! Form::input('number','quantity[]',(old('quantity') ? old('quantity')[$index] : ($vente->venteitems ? $oldventeItem->qte : 1) ), ['class' => 'form-control calcEvent quantity input-sm', 'id'=>"quantity" , 'required', 'step' => 'any', 'min' => '0']) !!}</div></td>
              <td><div class="form-group">{!! Form::input('number','price[]',(old('price') ? old('price')[$index] : ($vente->venteitems ? $oldventeItem->prix_unitaire : null) ), ['class' => 'form-control calcEvent price input-sm', 'id'=>"price", 'required','step' => 'any', 'min' => '0']) !!}</div></td>
              <td><div class="form-group">{!! Form::input('number','tax[]',(old('tax') ? old('tax')[$index] : ($vente->venteitems ? $oldventeItem->tax : 0) ), ['class' => 'form-control calcEvent tax input-sm', 'id'=>"tax",'step' => 'any', 'min' => '0']) !!}</div></td>
              <td class="text-right">
                <input type="hidden" value="" name="itemTotal[]">
                <span class="itemTotal">0.00</span>
            </td>
          </tr>
        @endforeach
      </tbody>
  </table>
</div><!-- /.col -->
<div class="row">
<div class="col-md-6">
  <span id="btn_add_row" class="btn btn-xs btn-info btn_add_row"><i class="fa fa-plus"></i>Ajouter une ligne</span>
</div><!-- /.col -->
<div class="col-md-6">
  <table class="table">
      <tbody>
      <tr>
          <th style="width:50%">Montant HT</th>
          <td class="text-right">
              <input type="hidden" value="" name="subTotal">
              <span id="subTotal">0.00</span>
          </td>
      </tr>
      <tr>
          <th>Tax</th>
          <td class="text-right">
              <input type="hidden" value="" name="taxTotal">
              <span id="taxTotal">0.00</span>
          </td>
      </tr>
      <tr class="amount_due">
          <th>Total TTC:</th>
          <td class="text-right">
              <input type="hidden" value="" name="grandTotal">
              <span class="currencySymbol" style="display: inline-block;"></span>
              <span id="grandTotal">0.00</span>
          </td>
      </tr>
      </tbody>
  </table>
</div>
</div>


{{-- <div class="col-md-12"> --}}
  <div class="form-group">
      <label for="note">Note</label>
      <textarea id="elm1" name="note">{{ old('note',$vente ? $vente->note : '') }}</textarea>
  </div>
{{-- </div> --}}
<div class="col-md-12">
  <button type="submit" class="btn btn-xs btn-success float-right" id="saveInvoice"><i class="fa fa-save"></i>{{$slot}}</button>
</div>
</div>
