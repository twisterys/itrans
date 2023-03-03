<input type="hidden" value="{{$vehicle}}" name="vehicle_id">
<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-4 col-form-label">Fournisseur<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client" type="text" value="{{old('client',$exctinteur ? $exctinteur->client : '')}}" id="example-text-input">
                @if($errors->has('client'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-4 col-form-label">Dernier Date de Controle<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('date_last_control') ? 'is-invalid' : '' }}" name="date_last_control" type="date" value="{{old('date_last_control',$exctinteur ? $exctinteur->date_last_control : '')}}" id="example-date-input">
                @if($errors->has('date_last_control'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_last_control') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-4 col-form-label">Prochaine Date de Controle<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('date_next_control') ? 'is-invalid' : '' }}" name="date_next_control" type="date" value="{{old('date_next_control',$exctinteur ? $exctinteur->date_next_control : '')}}" id="example-date-input">
                @if($errors->has('date_next_control'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_next_control') }}
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