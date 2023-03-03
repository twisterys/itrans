<div class="row">
    <div class="col-5">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">Nom<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"  type="text" value="{{old('name',$typePackaging ? $typePackaging->name : '')}}" id="example-text-input">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-2">
        <button class="btn btn-info">{{$slot}}</button>
    </div>

</div>
