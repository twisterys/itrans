<div class="row">
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-3 col-form-label">Type</label>
            <div class="col-md-9">
                <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Assurance::TYPE_ASSURANCE as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $assurance ? $assurance->type : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
{{--            <label for="example-date-input" class="col-md-3 col-form-label">Date</label>--}}
            <label for="example-date-input" class="col-md-3 col-form-label">Date<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date" type="date" value="{{old('date',$assurance ? $assurance->date : '')}}" id="example-date-input">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
{{--            <label for="example-date-input" class="col-md-3 col-form-label">Expire le</label>--}}

            <label for="example-date-input" class="col-md-3 col-form-label">Expire le<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('expiration') ? 'is-invalid' : '' }}" name="expiration" type="date" value="{{old('expiration',$assurance ? $assurance->expiration : '')}}" id="example-date-input">
                @if($errors->has('expiration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('expiration') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Assureur</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('assureur') ? 'is-invalid' : '' }}" name="assureur" type="text" value="{{old('assureur',$assurance ? $assurance->assureur : '')}}" id="example-text-input">
                @if($errors->has('assureur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('assureur') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Police</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('police') ? 'is-invalid' : '' }}" name="police" type="text" value="{{old('color',$assurance ? $assurance->police : '')}}" id="example-text-input">
                @if($errors->has('police'))
                    <div class="invalid-feedback">
                        {{ $errors->first('police') }}
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
