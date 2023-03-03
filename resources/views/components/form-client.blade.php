<div class="row">
    <div class="col-6">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">Nom<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" name="nom"  type="text" value="{{old('nom',$client ? $client->nom : '')}}" id="example-text-input">
                @if($errors->has('nom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nom') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">Num Douane</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('n_douane') ? 'is-invalid' : '' }}" name="n_douane"  type="text" value="{{old('n_douane',$client ? $client->n_douane : '')}}" id="example-text-input">
                @if($errors->has('n_douane'))
                    <div class="invalid-feedback">
                        {{ $errors->first('n_douane') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-2 col-form-label">Type</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    @foreach($typeClient as $key => $label)
                        <option value="{{ $label->id }}" {{ (old('type',$client ? $client->type : ''))  == $label->id ? 'selected' : '' }}>{{ $label->name }}</option>
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
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-2 col-form-label">Date 1ére relation</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('date_prem_relation') ? 'is-invalid' : '' }}" name="date_prem_relation" type="date" value="{{old('date_prem_relation',$client ? $client->date_prem_relation : '')}}" id="example-date-input">
                @if($errors->has('date_prem_relation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_prem_relation') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">email</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"  type="text" value="{{old('email',$client ? $client->email : '')}}" id="example-text-input">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">Téléphone 1</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('mobile_1') ? 'is-invalid' : '' }}" name="mobile_1"  type="text" value="{{old('mobile_1',$client ? $client->mobile_1 : '')}}" id="example-text-input">
                @if($errors->has('mobile_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile_1') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">Téléphone 2</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('mobile_2') ? 'is-invalid' : '' }}" name="mobile_2"  type="text" value="{{old('mobile_2',$client ? $client->mobile_2 : '')}}" id="example-text-input">
                @if($errors->has('mobile_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile_2') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">Autre info</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('autre_info') ? 'is-invalid' : '' }}" name="autre_info"  type="text" value="{{old('autre_info',$client ? $client->autre_info : '')}}" id="example-text-input">
                @if($errors->has('autre_info'))
                    <div class="invalid-feedback">
                        {{ $errors->first('autre_info') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="float-right">
    <button class="btn btn-info">{{$slot}}</button>
</div>