<div class="row">
    <div class="col-4">
        <div class="form-group">
            <label for="example-text-input" class=" col-form-label">Identifiant</label>
            
                <input class="form-control {{ $errors->has('identifiant') ? 'is-invalid' : '' }}" name="identifiant"  type="text" value="{{old('identifiant',$transporteur ? $transporteur->identifiant : '')}}" id="example-text-input">
                @if($errors->has('identifiant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identifiant') }}
                    </div>
                @endif
            
        </div>
    </div>
    <div class="col-4">
        <div class="form-group">
            <label for="example-text-input" class=" col-form-label">Nom</label>
            
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"  type="text" value="{{old('name',$transporteur ? $transporteur->name : '')}}" id="example-text-input">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif

        </div>
    </div>
    <div class="col-4">
        <div class="form-group ">
            <label for="example-text-input" class="col-form-label">Nationnalité</label>
            
                <input class="form-control {{ $errors->has('nationnalite') ? 'is-invalid' : '' }}" name="nationnalite"  type="text" value="{{old('nationnalite',$transporteur ? $transporteur->nationnalite : '')}}" id="example-text-input">
                @if($errors->has('nationnalite'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationnalite') }}
                    </div>
                @endif
        </div>
    </div>
</div>
<div class="float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>