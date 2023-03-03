<div class="row">
    <div class="col-6">
        <div class="form-group row ">
            <label class="col-md-3 col-form-label">Client<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <select class="form-control select2  {{ $errors->has('client_id') ? 'is-invalid' : '' }}" name="client_id">
                    <option value="" selected>Open this select menu</option>
                    @foreach($clients as $label)
                        <option value="{{ $label->id }}" {{ old('client_id', $magasinage ? $magasinage->client_id : '') ==  $label->id ? 'selected' : '' }}>{{ $label->nom }}</option>
                    @endforeach
                </select>
                @if($errors->has('client_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('client_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row mb-0">
            <label class="col-md-3 col-form-label">Depot<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <select class="form-control select2  {{ $errors->has('depot_id') ? 'is-invalid' : '' }}" name="depot_id">
                    <option value="" selected>Open this select menu</option>
                    @foreach($depots as $label)
                        <option value="{{ $label->id }}" {{ old('depot_id', $magasinage ? $magasinage->depot_id : '') ==  $label->id ? 'selected' : '' }}>{{ $label->nom.'('.$label->ville.')' }}</option>
                    @endforeach
                </select>
                @if($errors->has('depot_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('depot_id') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-3 col-form-label">Date Entrée<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date_entree') ? 'is-invalid' : '' }}" name="date_entree" type="date" value="{{old('date_entree',$magasinage ? $magasinage->date_entree : '')}}" id="example-date-input">
                @if($errors->has('date_entree'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_entree') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-3 col-form-label">Date Sortie</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date_sortie') ? 'is-invalid' : '' }}" name="date_sortie" type="date" value="{{old('date_sortie',$magasinage ? $magasinage->date_sortie : '')}}" id="example-date-input">
                @if($errors->has('date_sortie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_sortie') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-3 col-form-label">Matricule Entrée<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('mat_entree') ? 'is-invalid' : '' }}" name="mat_entree" type="text" value="{{old('mat_entree',$magasinage ? $magasinage->mat_entree : '')}}" id="example-date-input">
                @if($errors->has('mat_entree'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mat_entree') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-3 col-form-label">Matricule Sortie</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('mat_sortie') ? 'is-invalid' : '' }}" name="mat_sortie" type="text" value="{{old('mat_sortie',$magasinage ? $magasinage->mat_sortie : '')}}" id="example-date-input">
                @if($errors->has('mat_sortie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mat_sortie') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-3 col-form-label">Prix<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" name="prix" type="number" value="{{old('prix',$magasinage ? $magasinage->prix : '')}}" id="example-number-input" step=0.01>
                @if($errors->has('prix'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prix') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
                <label class="col-md-3 col-form-label">Plomos</label>
                <div class="col-md-9">
                    <select name="plomos[]" class="select2 form-control select2-multiple " multiple="multiple" data-placeholder="Choisir ...">
                            @foreach ($plomos as $plomo)
                                
                                <option value="{{$plomo->id}}" {{ in_array($plomo->id, old('plomos', [])) || ($magasinage ? $magasinage->plomos->contains($plomo->id) : null) ? 'selected' : '' }}>{{$plomo->num_serie}}</option>
                                
                            @endforeach
                    
                    </select>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row ">
            <label for="num_bon" class="col-md-3 col-form-label">N° Bon<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('num_bon') ? 'is-invalid' : '' }}" type="text" name="num_bon" value="{{old('num_bon',$magasinage ? $magasinage->num_bon : '')}}" id="num_bon">
                @if($errors->has('num_bon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('num_bon') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    {{-- <div class="col-6">
        <div class="card border border-info"">
            <div class="card-header bg-info text-white ">
                N° Bon
            </div>
            <div class="card-body">
                <div class="form-group row ">
                    <label for="num_bon" class="col-md-2 col-form-label">N° Bon</label>
                    <div class="col-md-10">
                        <input class="form-control client clientInfo {{ $errors->has('num_bon') ? 'is-invalid' : '' }}" type="text" name="num_bon" value="{{old('num_bon',$magasinage ? $magasinage->num_bon : '')}}" id="num_bon">
                        @if($errors->has('num_bon'))
                            <div class="invalid-feedback">
                                {{ $errors->first('num_bon') }}
                            </div>
                        @endif
                    </div>
                </div>
            
                    <span id="error-dropzone"></span>
                    <div class="form-group" >
                        <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="docdropzone">
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
    </div> --}}
    <div class="col-6">
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
    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
</div>
<div class="mt-3 float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>