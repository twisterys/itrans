<div class="row">
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Nom<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" name="nom" type="text" value="{{old('nom',$station ? $station->nom : '')}}" id="example-text-input">
                @if($errors->has('nom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nom') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Ville<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" name="ville" type="text" value="{{old('ville',$station ? $station->ville : '')}}" id="example-text-input">
                @if($errors->has('ville'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ville') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Adress<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('adress') ? 'is-invalid' : '' }}" name="adress" type="text" value="{{old('adress',$station ? $station->adress : '')}}" id="example-text-input">
                @if($errors->has('adress'))
                    <div class="invalid-feedback">
                        {{ $errors->first('adress') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="mt-3 float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>