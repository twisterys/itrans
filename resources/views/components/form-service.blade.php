<div class="row">
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Prestation<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('service') ? 'is-invalid' : '' }}" name="service" type="text" value="{{old('service',$service ? $service->service : '')}}" id="example-text-input">
                @if($errors->has('service'))
                <div class="invalid-feedback">
                    {{ $errors->first('service') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">prix<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('service_price') ? 'is-invalid' : '' }}" name="service_price" type="text" value="{{old('service_price',$service ? $service->service_price : '')}}" id="example-text-input">
                @if($errors->has('service_price'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_price') }}
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Commentaire<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('service_comment') ? 'is-invalid' : '' }}" name="service_comment" type="text" value="{{old('service_comment',$service ? $service->service_comment : '')}}" id="example-text-input">
                @if($errors->has('service_comment'))
                <div class="invalid-feedback">
                    {{ $errors->first('service_comment') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="mt-3 float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>
