<div class="row">
    <div class="form-group col-md-4">
        <label for="nom">Nom</label>
        <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" type="text" name="nom" id="nom" value="{{ old('nom',$shema ? $shema->nom : '') }}">
        @if($errors->has('nom'))
            <div class="invalid-feedback">
                {{ $errors->first('nom') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label class="required">Type</label>
        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="pay_status" >
            <option value disabled {{ old('pay_status', null) === null ? 'selected' : '' }}>Selectionner SVP</option>
            @foreach(App\Shema::TYPE_SELECT as $key => $label)
              <option value="{{ $key }}" {{ (old('type') ? old('type') : $shema->type ?? '') == $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('type'))
            <div class="invalid-feedback">
                {{ $errors->first('type') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label for="date">Date</label>
        <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date" type="date" value="{{old('date',$shema ? $shema->date : '')}}" id="date">
        @if($errors->has('date'))
            <div class="invalid-feedback">
                {{ $errors->first('date') }}
            </div>
        @endif
    </div>
    <div class="form-group col-md-4">
        <label class="required" for="start_from">Commencé de</label>
        <input class="form-control {{ $errors->has('start_from') ? 'is-invalid' : '' }}" type="number" name="start_from" id="start_from" value="{{ old('start_from',$shema ? $shema->start_from : 1) }}" step="1" required>
        @if($errors->has('start_from'))
            <div class="invalid-feedback">
                {{ $errors->first('start_from') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label for="prefix">Préfixe</label>
        <input class="form-control {{ $errors->has('prefix') ? 'is-invalid' : '' }}" type="text" name="prefix" id="prefix" value="{{ old('prefix',$shema ? $shema->prefix : '') }}">
        @if($errors->has('prefix'))
            <div class="invalid-feedback">
                {{ $errors->first('prefix') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label for="suffix">Suffixe</label>
        <input class="form-control {{ $errors->has('suffix') ? 'is-invalid' : '' }}" type="text" name="suffix" id="suffix" value="{{ old('suffix',$shema ? $shema->suffix : '') }}">
        @if($errors->has('suffix'))
            <div class="invalid-feedback">
                {{ $errors->first('suffix') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label for="letterscount">Nombre de chiffre</label>
        <input class="form-control {{ $errors->has('letterscount') ? 'is-invalid' : '' }}" type="number" name="letterscount" id="letterscount" value="{{ old('letterscount',$shema ? $shema->letterscount : 3) }}" step="1">
        @if($errors->has('letterscount'))
            <div class="invalid-feedback">
                {{ $errors->first('letterscount') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label for="current">Nombre de facture</label>
        <input class="form-control {{ $errors->has('current') ? 'is-invalid' : '' }}" type="number" name="current" id="current" value="{{ old('current',$shema ? $shema->current : 0) }}" step="1">
        @if($errors->has('current'))
            <div class="invalid-feedback">
                {{ $errors->first('current') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
</div>
<div class="mt-3 float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>