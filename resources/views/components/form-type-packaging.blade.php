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
    <div class="col-5">
        <div class="">
            <div class="row custom-radio">
                <label for="example-text-input" class="col-md-2 col-form-label">Active</label>
                <div class="col-2 mt-2">
                    <input type="radio" id="customRadio1" value=0 {{ old('active',$typePackaging ? $typePackaging->active : 0) == 0 ? 'checked' : '' }} name="active" class="custom-control-input"   checked>
                    <label class="custom-control-label" for="customRadio1">Non</label>
                </div>
                <div class="col-2 mt-2">
                    <input type="radio" id="customRadio2" value=1 name="active" class="custom-control-input" {{ old('active',$typePackaging ? $typePackaging->active : 0) == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customRadio2">Oui</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-2">
        <button class="btn btn-info">{{$slot}}</button>
    </div>

</div>
