<div class="row">
    @if ($plomo)
        <div class="col-4">
            <div class="form-group row">
                <label for="example-text-input" class="col-md-3 col-form-label">Num Série</label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('num_serie') ? 'is-invalid' : '' }}" name="num_serie" type="text" value="{{old('num_serie',$plomo ? $plomo->num_serie : '')}}" id="example-text-input" disabled>
                </div>
            </div>
        </div>
    @endif
    <div class="col-4">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Prêter de</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('traiter_de') ? 'is-invalid' : '' }}" name="traiter_de" type="text" value="{{old('traiter_de',$plomo ? $plomo->traiter_de : '')}}" id="example-text-input">
                @if($errors->has('traiter_de'))
                    <div class="invalid-feedback">
                        {{ $errors->first('traiter_de') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if (!$plomo)
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-3 col-form-label">De</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" name="from" type="number" value="{{old('from',$plomo ? $plomo->from : '')}}" id="example-number-input" step=1>
                @if($errors->has('from'))
                    <div class="invalid-feedback">
                        {{ $errors->first('from') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-3 col-form-label">A</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" name="to" type="number" value="{{old('to',$plomo ? $plomo->to : '')}}" id="example-number-input" step=1>
                @if($errors->has('to'))
                    <div class="invalid-feedback">
                        {{ $errors->first('to') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif
    @if ($plomo)
        <div class="col-4">
            <div class="form-group row">
                <label for="example-text-input" class="col-md-3 col-form-label">Prêter pour</label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('traiter_a') ? 'is-invalid' : '' }}" name="traiter_a" type="text" value="{{old('traiter_a',$plomo ? $plomo->traiter_a : '')}}" id="example-text-input">
                    @if($errors->has('traiter_a'))
                        <div class="invalid-feedback">
                            {{ $errors->first('traiter_a') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group row">
                <label for="example-text-input" class="col-md-3 col-form-label">Defaillante</label>
                <div class="col-md-9">
                    <input type="checkbox" id="switch1" switch="none" name="defaillante" {{$plomo->defaillante ? 'checked' : ''}}/>
                    <label for="switch1" data-on-label="On" data-off-label="Off"></label>
                    @if($errors->has('defaillante'))
                        <div class="invalid-feedback">
                            {{ $errors->first('defaillante') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
<div class="float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>
