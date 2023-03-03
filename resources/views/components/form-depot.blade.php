<div class="row">
    <div class="col-5">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Nom<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" name="nom" type="text" value="{{old('nom',$depot ? $depot->nom : '')}}" id="example-text-input">
                @if($errors->has('nom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nom') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Ville<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" name="ville" type="text" value="{{old('ville',$depot ? $depot->ville : '')}}" id="example-text-input">
                @if($errors->has('ville'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ville') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-2 float-right">
        <button type="submit" class="btn btn-info">{{$slot}}</button>
    </div>
</div>
