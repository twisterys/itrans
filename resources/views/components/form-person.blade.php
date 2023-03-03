<div class="row">
    <div class="col-4">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-4 col-form-label">Matricule<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('matricule') ? 'is-invalid' : '' }}" name="matricule"  type="text" value="{{old('matricule',$person ? $person->matricule : '')}}" id="example-text-input">
                @if($errors->has('matricule'))
                    <div class="invalid-feedback">
                        {{ $errors->first('matricule') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4"></div>

    <div class="col-4">
        <div class="card bg-secondary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mt-4 mt-lg-0">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Mensuele" name="categorie" value="mensuele" {{ old('type', $person ? $person->categorie : '') === 'mensuele' ? 'checked' : '' }} class="custom-control-input" checked>
                                <label class="custom-control-label text-dark" for="Mensuele">Mensuele</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mt-4 mt-lg-0">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="Horaire" name="categorie" value="horaire" {{ old('type', $person ? $person->categorie : '') === 'horaire' ? 'checked' : '' }} class="custom-control-input" >
                                <label class="custom-control-label text-dark" for="Horaire">Horaire</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<fieldset class="border p-2 mb-3">
    <legend  class="float-none w-auto p-2">Identification</legend>
<div class="row">
    <div class="col-4">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-4 col-form-label">Nom<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" name="nom"  type="text" value="{{old('nom',$person ? $person->nom : '')}}" id="example-text-input">
                @if($errors->has('nom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nom') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-4 col-form-label">Prénom<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" name="prenom"  type="text" value="{{old('prenom',$person ? $person->prenom : '')}}" id="example-text-input">
                @if($errors->has('prenom'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prenom') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-4 col-form-label">Date Naissance<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('date_naiss') ? 'is-invalid' : '' }}" name="date_naiss" type="date" value="{{old('date_naiss',$person ? $person->date_naiss : '')}}" id="example--input">
                @if($errors->has('date_naiss'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_naiss') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-4 col-form-label">Situation Familiale</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('situation_familiale') ? 'is-invalid' : '' }}" name="situation_familiale">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::SITUATION_FAMILIALE as $key => $label)
                        <option value="{{ $key }}" {{ old('situation_familiale', $person ? $person->situation_familiale : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('situation_familiale'))
                    <div class="invalid-feedback">
                        {{ $errors->first('situation_familiale') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-4 col-form-label">Nationnalité</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('nationalite') ? 'is-invalid' : '' }}" name="nationalite">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::NATIONALITE as $key => $label)
                        <option value="{{ $key }}" {{ old('nationalite', $person ? $person->nationalite : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('nationalite'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationalite') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-4 col-form-label">CIN<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('cin') ? 'is-invalid' : '' }}" name="cin"  type="text" value="{{old('cin',$person ? $person->cin : '')}}" id="example-text-input">
                @if($errors->has('cin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cin') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">Nbre Enfants</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('nbre_enfant') ? 'is-invalid' : '' }}" name="nbre_enfant" type="number" value="{{old('nbre_enfant',$person ? $person->nbre_enfant : 0)}}" id="example-number-input">
                @if($errors->has('nbre_enfant'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nbre_enfant') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-4 col-form-label">Tél</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('tele') ? 'is-invalid' : '' }}" name="tele"  type="text" value="{{old('tele',$person ? $person->tele : '')}}" id="example-text-input">
                @if($errors->has('tele'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tele') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-4 col-form-label">Sexe</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('sexe') ? 'is-invalid' : '' }}" name="sexe">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::SEXE as $key => $label)
                        <option value="{{ $key }}" {{ old('sexe', $person ? $person->sexe : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('sexe'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sexe') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">Nb Déduction</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('nb_deduction') ? 'is-invalid' : '' }}" name="nb_deduction" type="number" value="{{old('nb_deduction',$person ? $person->nb_deduction : 0)}}" id="example-number-input">
                @if($errors->has('nb_deduction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nb_deduction') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-4 col-form-label">Transport</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('transport') ? 'is-invalid' : '' }}" name="transport">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::TRANSPORT as $key => $label)
                        <option value="{{ $key }}" {{ old('transport', $person ? $person->transport : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('transport'))
                    <div class="invalid-feedback">
                        {{ $errors->first('transport') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-2 col-form-label">Adress</label>
            <div class="col-md-10">
                <input class="form-control {{ $errors->has('adress') ? 'is-invalid' : '' }}" name="adress"  type="text" value="{{old('adress',$person ? $person->adress : '')}}" id="example-text-input">
                @if($errors->has('adress'))
                    <div class="invalid-feedback">
                        {{ $errors->first('adress') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-4 col-form-label">Ville</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" name="ville"  type="text" value="{{old('ville',$person ? $person->ville : '')}}" id="example-text-input">
                @if($errors->has('ville'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ville') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</fieldset>
<fieldset class="border p-2 mb-3">
    <legend  class="float-none w-auto p-2">Status</legend>
<div class="row">
    <div class="col-6">
        <div class="form-group row mb-0">
            <label class="col-md-3 col-form-label">Fonction<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <select class="custom-select {{ $errors->has('fonction') ? 'is-invalid' : '' }}" name="fonction">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::FONCTION as $key => $label)
                        <option value="{{ $key }}" {{ old('fonction', $person ? $person->fonction : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('fonction'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fonction') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-3 col-form-label">Date Embauche</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date_embauche') ? 'is-invalid' : '' }}" name="date_embauche" type="date" value="{{old('date_embauche',$person ? $person->date_embauche : '')}}" id="example-date-input">
                @if($errors->has('date_embauche'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_embauche') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row mb-0">
            <label class="col-md-3 col-form-label">Section</label>
            <div class="col-md-9">
                <select class="custom-select {{ $errors->has('section') ? 'is-invalid' : '' }}" name="section">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::SECTION as $key => $label)
                        <option value="{{ $key }}" {{ old('section', $person ? $person->section : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('section'))
                    <div class="invalid-feedback">
                        {{ $errors->first('section') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-3 col-form-label">Date Départ</label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date_depart') ? 'is-invalid' : '' }}" name="date_depart" type="date" value="{{old('date_depart',$person ? $person->date_depart : '')}}" id="example-date-input">
                @if($errors->has('date_depart'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_depart') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
</fieldset>
<fieldset class="border p-2 mb-3">
    <legend  class="float-none w-auto p-2">Elements Salaire</legend>
<div class="row">
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">Salaire de Base</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('salaire_base') ? 'is-invalid' : '' }}" name="salaire_base" type="number" value="{{old('salaire_base',$person ? $person->salaire_base : '0.00')}}" id="example-number-input" step="0.01">
                @if($errors->has('salaire_base'))
                    <div class="invalid-feedback">
                        {{ $errors->first('salaire_base') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-4 col-form-label">Banque</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('banque') ? 'is-invalid' : '' }}" name="banque">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::BANK_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('banque', $person ? $person->banque : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('banque'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banque') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">Prime présentation</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('prime_presentation') ? 'is-invalid' : '' }}" name="prime_presentation" type="number" value="{{old('prime_presentation',$person ? $person->prime_presentation : '0.00')}}" id="example-number-input" step="0.01">
                @if($errors->has('prime_presentation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prime_presentation') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4"></div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">N° Camp Banc</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('N_Cmp_Banc') ? 'is-invalid' : '' }}" name="N_Cmp_Banc" type="number" value="{{old('N_Cmp_Banc',$person ? $person->N_Cmp_Banc : '')}}" id="example-number-input">
                @if($errors->has('N_Cmp_Banc'))
                    <div class="invalid-feedback">
                        {{ $errors->first('N_Cmp_Banc') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">Prime de panier</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('prime_panier') ? 'is-invalid' : '' }}" name="prime_panier" type="number" value="{{old('prime_panier',$person ? $person->prime_panier : '0.00')}}" id="example-number-input" step="0.01">
                @if($errors->has('prime_panier'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prime_panier') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">Taux Horaire</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('taux_horaire') ? 'is-invalid' : '' }}" name="taux_horaire" type="number" value="{{old('taux_horaire',$person ? $person->taux_horaire : '0.00')}}" id="example-number-input" step="0.01">
                @if($errors->has('taux_horaire'))
                    <div class="invalid-feedback">
                        {{ $errors->first('taux_horaire') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-4 col-form-label">Mode de Réglement</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('mode_reglement') ? 'is-invalid' : '' }}" name="mode_reglement">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::MODE_REGLEMENT as $key => $label)
                        <option value="{{ $key }}" {{ old('mode_reglement', $person ? $person->mode_reglement : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('mode_reglement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mode_reglement') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-4 col-form-label">Prime de Logement</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('prime_logement') ? 'is-invalid' : '' }}" name="prime_logement" type="number" value="{{old('prime_logement',$person ? $person->prime_logement : '0.00')}}" id="example-number-input" step="0.01">
                @if($errors->has('prime_logement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('prime_logement') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
</fieldset>
<fieldset class="border p-2 mb-3">
    <legend  class="float-none w-auto p-2">Organismes sociaux</legend>
<div class="row">
    <div class="col-4">
        <div class="form-group row mb-0">
            <label class="col-md-4 col-form-label">Retraite</label>
            <div class="col-md-8">
                <select class="custom-select {{ $errors->has('retraite') ? 'is-invalid' : '' }}" name="retraite">
                    <option value="" selected>Open this select menu</option>
                    @foreach(App\Person::RETRAITE as $key => $label)
                        <option value="{{ $key }}" {{ old('retraite', $person ? $person->retraite : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('retraite'))
                    <div class="invalid-feedback">
                        {{ $errors->first('retraite') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row ">
            <label for="example-text-input" class="col-md-4 col-form-label">CNSS</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('cnss') ? 'is-invalid' : '' }}" name="cnss"  type="text" value="{{old('cnss',$person ? $person->cnss : '')}}" id="example-text-input">
                @if($errors->has('cnss'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cnss') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-4 col-form-label">Date Affiliation</label>
            <div class="col-md-8">
                <input class="form-control {{ $errors->has('date_affiliation') ? 'is-invalid' : '' }}" name="date_affiliation" type="date" value="{{old('date_affiliation',$person ? $person->date_affiliation : '')}}" id="example-date-input">
                @if($errors->has('date_affiliation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_affiliation') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

</div>
</fieldset>

<div class="row">
{{--    <div class="col-6">--}}
{{--        <div class="form-group row ">--}}
{{--            <label for="example-text-input" class="col-md-3 col-form-label">Photo</label>--}}
{{--            <div class="col-md-9">--}}
    <div class="col-5" style="height: 20%;">
        <div class="form-group row">
            <label for="example-text-input" class="col-md-4 col-form-label">Photo</label>
            <div class="col-md-8">
                <input type="file" class="filepond" name="file" id="filepond" accept="image/png, image/jpeg, image/gif, image/jpg">
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                {{-- <span class="help-block">Width (px):100<br/>
                    Height (px):50</span> --}}
            </div>
        </div>
    </div>

</div>


<div class="mt-3">
    <button type="submit" class="btn btn-info float-right">{{$slot}}</button>
</div>

@section('script')
<script>
    if($('input[name=categorie]:checked').val() == 'horaire'){
        $("input[name=taux_horaire]").prop('disabled', false);
        $("input[name=salaire_base]").prop('disabled', true);
        $("input[name=salaire_base]").val('0.00')
    }
    if($('input[name=categorie]:checked').val() == 'mensuele'){
        $("input[name=taux_horaire]").prop('disabled', true);
        $("input[name=salaire_base]").prop('disabled', false);
        $("input[name=taux_horaire]").val('0.00')
    }
    $(document).ready(function() {

        $('input[name=categorie]').on('change', function() {
            if($('input[name=categorie]:checked').val() == 'horaire'){
                $("input[name=taux_horaire]").prop('disabled', false);
                $("input[name=salaire_base]").prop('disabled', true);

                $("input[name=salaire_base]").val('0.00')
            }
            if($('input[name=categorie]:checked').val() == 'mensuele'){
                $("input[name=taux_horaire]").prop('disabled', true);
                $("input[name=salaire_base]").prop('disabled', false);
                $("input[name=taux_horaire]").val('0.00')

            }
        });

    });
</script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    const input = document.querySelector('input[id="filepond"]');
    FilePond.registerPlugin(FilePondPluginFileValidateType);
    const pond=FilePond.create(input);

<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-edit/dist/filepond-plugin-image-edit.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
<script>
    const input = document.querySelector('input[id="filepond"]');

    FilePond.registerPlugin(
        FilePondPluginFileValidateType,
        FilePondPluginImageExifOrientation,
        FilePondPluginImagePreview,
        FilePondPluginImageCrop,
        FilePondPluginImageResize,
        FilePondPluginImageTransform,
        FilePondPluginImageEdit
    );

    const pond=FilePond.create(input,
    {
    labelIdle: `Déposer un photo ici`,
    imagePreviewHeight: 120,
    imageCropAspectRatio: '1:1',
    imageResizeTargetWidth: 100,
    imageResizeTargetHeight: 100,
    stylePanelLayout: 'compact circle',
    styleLoadIndicatorPosition: 'center bottom',
    styleProgressIndicatorPosition: 'right bottom',
    styleButtonRemoveItemPosition: 'left bottom',
    styleButtonProcessItemPosition: 'right bottom',
  }
    );
    FilePond.setOptions({
        server:{
            url:'{{ route('person.storeMedia') }}',
            headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },

    },
    success: function (file, response) {
        console.log(response.name)
           $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')

       },
    labelIdle: "Déposer un photo ici",

});
</script>

@endsection

