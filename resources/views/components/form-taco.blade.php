<input type="hidden" value="{{$vehicle}}" name="vehicle_id">
<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-4 col-form-label">N° Homologation<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('num_homologation') ? 'is-invalid' : '' }}" name="num_homologation" type="text" value="{{old('num_homologation',$taco ? $taco->num_homologation : '')}}" id="example-text-input">
                @if($errors->has('num_homologation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('num_homologation') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-4 col-form-label">Marque<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('marque') ? 'is-invalid' : '' }}" name="marque" type="text" value="{{old('marque',$taco ? $taco->marque : '')}}" id="example-text-input">
                @if($errors->has('marque'))
                    <div class="invalid-feedback">
                        {{ $errors->first('marque') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-4 col-form-label">N° Série<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('num_serie') ? 'is-invalid' : '' }}" name="num_serie" type="text" value="{{old('num_serie',$taco ? $taco->num_serie : '')}}" id="example-text-input">
                @if($errors->has('num_serie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('num_serie') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-4 col-form-label">Date de Validité<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('date_validation') ? 'is-invalid' : '' }}" name="date_validation" type="date" value="{{old('date_validation',$taco ? $taco->date_validation : '')}}" id="example-date-input">
                @if($errors->has('date_validation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_validation') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-4 col-form-label">Date d'expiration<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('date_expiration') ? 'is-invalid' : '' }}" name="date_expiration" type="date" value="{{old('date_expiration',$taco ? $taco->date_expiration : '')}}" id="example-date-input">
                @if($errors->has('date_expiration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_expiration') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-10 mx-auto">
        <span id="error-dropzone"></span>
        <div class="form-group">
            <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="doc-dropzone">
            </div>
            @if($errors->has('file'))
                <div class="invalid-feedback">
                    {{ $errors->first('file') }}
                </div>
            @endif
        </div>
        <span class="help-block"></span>
    </div>
</div>

<div class="mt-3 float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>