
    <div class="row">

        <div class="col-3">
            <div class="form-group">
                    <label for="example-text-input">N° Immatriculation<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('N_immatriculation') ? 'is-invalid' : '' }}" name="N_immatriculation"  type="text" value="{{old('N_immatriculation',$vehicle ? $vehicle->N_immatriculation : '')}}" id="example-text-input">
                    @if($errors->has('N_immatriculation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('N_immatriculation') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                
                    <label for="example-date-input">Premiére Mise en Ciculation<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('date_pre_mise_circul') ? 'is-invalid' : '' }}" name="date_pre_mise_circul" type="date" value="{{old('date_pre_mise_circul',$vehicle ? $vehicle->date_pre_mise_circul : '')}}" id="example--input">
                    @if($errors->has('date_pre_mise_circul'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date_pre_mise_circul') }}
                        </div>
                    @endif
                </div>
        </div>
        <div class="col-3">
            <div class="form-group"> 
                    <label for="example-date-input">M.C au Maroc<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('date_m_c_maroc') ? 'is-invalid' : '' }}" name="date_m_c_maroc" type="date" value="{{old('date_m_c_maroc',$vehicle ? $vehicle->date_m_c_maroc : '')}}" id="example--input">
                    @if($errors->has('date_m_c_maroc'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date_m_c_maroc') }}
                        </div>
                    @endif
                
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-date-input">Mutation le<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('date_mutation') ? 'is-invalid' : '' }}" name="date_mutation" type="date" value="{{old('date_mutation',$vehicle ? $vehicle->date_mutation : '')}}" id="example--input">
                    @if($errors->has('date_mutation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date_mutation') }}
                        </div>
                    @endif
                
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-date-input">Date de validité</label>
                    <input class="form-control {{ $errors->has('date_debut_validite') ? 'is-invalid' : '' }}" name="date_debut_validite" type="date" value="{{old('date_debut_validite',$vehicle ? $vehicle->date_debut_validite : '')}}" id="example--input">
                    @if($errors->has('date_debut_validite'))
                        <div class="invalid-feedback">
                            {{ $errors->first('date_debut_validite') }}
                        </div>
                    @endif
                </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-text-input">Propriétaire<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('proprietaire') ? 'is-invalid' : '' }}" name="proprietaire" type="text" value="{{old('proprietaire',$vehicle ? $vehicle->proprietaire : '')}}" id="example-text-input">
                    @if($errors->has('proprietaire'))
                        <div class="invalid-feedback">
                            {{ $errors->first('proprietaire') }}
                        </div>
                    @endif
            </div>
        </div>
        
        <div class="col-3">
            <div class="form-group">
                <label for="example-text-input">Marque<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('marque') ? 'is-invalid' : '' }}" name="marque" type="text" value="{{old('marque',$vehicle ? $vehicle->marque : '')}}" id="example-text-input">
                    @if($errors->has('marque'))
                        <div class="invalid-feedback">
                            {{ $errors->first('marque') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-text-input">Type<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" type="text" value="{{old('type',$vehicle ? $vehicle->type : '')}}" id="example-text-input">
                    @if($errors->has('type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="genre">Genre<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <select class="custom-select {{ $errors->has('genre') ? 'is-invalid' : '' }}" name="genre" id="genre">
                        <option selected>Open this select menu</option>
                        @foreach($typeVehicles as $key => $label)
                            <option value="{{ $label->name }}" {{ old('genre', $vehicle ? $vehicle->genre : '') === (string) $label->name ? 'selected' : '' }}>{{ $label->name }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('genre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('genre') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-text-input">Model<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('modele') ? 'is-invalid' : '' }}" name="modele" type="text" value="{{old('modele',$vehicle ? $vehicle->modele : '')}}" id="example-text-input">
                    @if($errors->has('modele'))
                        <div class="invalid-feedback">
                            {{ $errors->first('modele') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="type_carburant">Carburant</label>
                    <select class="custom-select {{ $errors->has('type_carburant') ? 'is-invalid' : '' }}" name="type_carburant" id="type_carburant">
                        <option selected>Open this select menu</option>
                        @foreach(App\Vehicle::TYPE_CARBURANT as $key => $label)
                            <option value="{{ $key }}" {{ old('type_carburant', $vehicle ? $vehicle->type_carburant : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type_carburant'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type_carburant') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-text-input">N° du chassis<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('num_chassis') ? 'is-invalid' : '' }}" name="num_chassis" type="text" value="{{old('num_chassis',$vehicle ? $vehicle->num_chassis : '')}}" id="example-text-input">
                    @if($errors->has('num_chassis'))
                        <div class="invalid-feedback">
                            {{ $errors->first('num_chassis') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-number-input">Nbre cylindres<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('nbr_cylindre') ? 'is-invalid' : '' }}" name="nbr_cylindre" type="number" value="{{old('nbr_cylindre',$vehicle ? $vehicle->nbr_cylindre : '')}}" id="example-number-input">
                    @if($errors->has('nbr_cylindre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nbr_cylindre') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-number-input">Puissance fiscale<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('puissance_fiscale') ? 'is-invalid' : '' }}" name="puissance_fiscale" type="number" value="{{old('puissance_fiscale',$vehicle ? $vehicle->puissance_fiscale : '')}}" id="example-number-input">
                    @if($errors->has('puissance_fiscale'))
                        <div class="invalid-feedback">
                            {{ $errors->first('puissance_fiscale') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-number-input">P.T.A.C<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('P_T_A_C') ? 'is-invalid' : '' }}" name="P_T_A_C" type="number" value="{{old('P_T_A_C',$vehicle ? $vehicle->P_T_A_C : '')}}" id="example-number-input">
                    @if($errors->has('P_T_A_C'))
                        <div class="invalid-feedback">
                            {{ $errors->first('P_T_A_C') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-number-input">Poids à vide<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                    <input class="form-control {{ $errors->has('poids_a_vide') ? 'is-invalid' : '' }}" name="poids_a_vide" type="number" value="{{old('poids_a_vide',$vehicle ? $vehicle->poids_a_vide : '')}}" id="example-number-input">
                    @if($errors->has('poids_a_vide'))
                        <div class="invalid-feedback">
                            {{ $errors->first('poids_a_vide') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-3">
            <div class="form-group">
                <label for="example-number-input">P.T.M.C.T</label>
                    <input class="form-control {{ $errors->has('P_T_M_C_T') ? 'is-invalid' : '' }}" name="P_T_M_C_T" type="number" value="{{old('P_T_M_C_T',$vehicle ? $vehicle->P_T_M_C_T : '')}}" id="example-number-input">
                    @if($errors->has('P_T_M_C_T'))
                        <div class="invalid-feedback">
                            {{ $errors->first('P_T_M_C_T') }}
                        </div>
                    @endif
            </div>
        </div>
        <div class="col-9 mx-auto">
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













