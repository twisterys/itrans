<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Nom<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" name="nom" type="text" value="{{old('nom',$transitaire ? $transitaire->nom : '')}}" id="example-text-input">
                @if($errors->has('nom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nom') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Ice</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('ice') ? 'is-invalid' : '' }}" name="ice" type="text" value="{{old('ice',$transitaire ? $transitaire->ice : '')}}" id="example-text-input">
                @if($errors->has('ice'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ice') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Numéro</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('numero') ? 'is-invalid' : '' }}" name="numero" type="text" value="{{old('numero',$transitaire ? $transitaire->numero : '')}}" id="example-text-input">
                @if($errors->has('numero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Email</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" type="text" value="{{old('email',$transitaire ? $transitaire->email : '')}}" id="example-text-input">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-3 col-form-label">Adress</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('adress') ? 'is-invalid' : '' }}" name="adress" type="text" value="{{old('adress',$transitaire ? $transitaire->adress : '')}}" id="example-text-input">
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