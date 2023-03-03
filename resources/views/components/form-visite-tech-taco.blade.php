<input type="hidden" value="{{$taco}}" name="taco_id">
<div class="row">
<div class="col-6">
    <div class="form-group row">
        <label for="example-text-input" class="col-md-3 col-form-label">Ref<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
        <div class="col-md-9">
            <input class="form-control {{ $errors->has('ref') ? 'is-invalid' : '' }}" name="ref" type="text" value="{{old('ref',$visiteTechnique ? $visiteTechnique->ref : '')}}" id="example-text-input">
            @if($errors->has('ref'))
                <div class="invalid-feedback">
                    {{ $errors->first('ref') }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="col-6">
    <div class="form-group row">
        <label for="example-date-input" class="col-md-3 col-form-label">Date derniére visite<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
        <div class="col-md-9">
            <input class="form-control {{ $errors->has('date_last_visit') ? 'is-invalid' : '' }}" name="date_last_visit" type="date" value="{{old('date_last_visit',$visiteTechnique ? $visiteTechnique->date_last_visit : '')}}" id="example-date-input">
            @if($errors->has('date_last_visit'))
                <div class="invalid-feedback">
                    {{ $errors->first('date_last_visit') }}
                </div>
            @endif
        </div>
    </div>
</div>
<div class="col-6">
    <div class="form-group row">
        <label for="example-date-input" class="col-md-3 col-form-label">Date prochaine visite<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
        <div class="col-md-9">
            <input class="form-control {{ $errors->has('date_next_visit') ? 'is-invalid' : '' }}" name="date_next_visit" type="date" value="{{old('date_next_visit',$visiteTechnique ? $visiteTechnique->date_next_visit : '')}}" id="example-date-input">
            @if($errors->has('date_next_visit'))
                <div class="invalid-feedback">
                    {{ $errors->first('date_next_visit') }}
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