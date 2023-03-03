<h3>Véhicules</h3>
<fieldset>
<x-form-import-vehicle :v="$vehicles" :typeVehicle="$typesVehicle"  :importVehicle="$import ? $import : null"></x-form-import-vehicle>
</fieldset>
<h3>Import</h3>
<fieldset>

<div class="row">
    <div class="col-6">
        <div class="form-group row">

{{--            <label for="example-date-input" class="col-md-3 col-form-label">Date <span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>--}}
            <div class="col-md-3">
                <label for="example-date-input" class=" col-form-label">Date <span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            </div>
            <div class="col-md-9">

                <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date" type="date" value="{{old('date',$import ? $import->date : '')}}" id="example-date-input">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
{{--            <label for="example-number-input" class="col-md-3 col-form-label">Connaissement N°<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>--}}
            <div class="col-md-3">
                <label for="example-number-input" class="col-form-label">Connaissement N°<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            </div>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('num_connaissement') ? 'is-invalid' : '' }}" name="num_connaissement" type="number" value="{{old('num_connaissement',$import ? $import->num_connaissement : '')}}" id="example-number-input">
                @if($errors->has('num_connaissement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('num_connaissement') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <div class="col-md-3">
                <label class="col-form-label">Chauffeurs</label>
            </div>
                <div class="col-md-8">
                    <select name="chauffeurs[]" class="select2 form-control select2-multiple" id="chauffeurs" multiple="multiple" data-placeholder="Choisir ...">
                            @foreach ($chauffeurs as $chauffeur)

                                <option value="{{$chauffeur->id}}" {{ in_array($chauffeur->id, old('chauffeurs', [])) || ($import ? $import->chauffeur->contains($chauffeur->id) : null) ? 'selected' : '' }}>{{$chauffeur->nom.' '.$chauffeur->prenom.'('.$chauffeur->cin.')'}}</option>

                            @endforeach

                    </select>
                </div>
                <div class="col-md-1 float-right">
                    <button type="button" class="btn btn-light waves-effect waves-light" data-toggle="modal" data-toggle="tooltip" title="Ajouter External Chauffeur" data-target=".modalChauffeur"><i class="fa fa-plus"></i></button>
                </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row ">
            <div class="col-md-3">
                <label for="example-text-input" class="col-form-label">Compagnie</label>
            </div>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('compagnie') ? 'is-invalid' : '' }}" name="compagnie"  type="text" value="{{old('compagnie',$import ? $import->compagnie : '')}}" id="example-text-input">
                @if($errors->has('compagnie'))
                    <div class="invalid-feedback">
                        {{ $errors->first('compagnie') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row ">
            <div class="col-md-3">
            <label for="example-text-input" class="col-form-label">provenance</label>
            </div>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('provenance') ? 'is-invalid' : '' }}" name="provenance"  type="text" value="{{old('provenance',$import ? $import->provenance : '')}}" id="example-text-input">
                @if($errors->has('provenance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provenance') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row ">
            <div class="col-md-3">
                <label for="example-text-input" class="col-form-label">Destination</label>
            </div>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('destination') ? 'is-invalid' : '' }}" name="destination"  type="text" value="{{old('destination',$import ? $import->destination : '')}}" id="example-text-input">
                @if($errors->has('destination'))
                    <div class="invalid-feedback">
                        {{ $errors->first('destination') }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="col-6">
        <div class="form-group row">
            <div class="col-md-3">
                <label for="example-date-input" class="col-form-label">Date Sortie</label>
            </div>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date_sortie') ? 'is-invalid' : '' }}" name="date_sortie" type="date" value="{{old('date_sortie',$import ? $import->date_sortie : '')}}" id="example-date-input">
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
            <div class="col-md-3">
                <label for="example-date-input" class="col-form-label">Date Arrivée</label>
            </div>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date_arrive') ? 'is-invalid' : '' }}" name="date_arrive" type="date" value="{{old('date_arrive',$import ? $import->date_arrive : '')}}" id="example-date-input">
                @if($errors->has('date_arrive'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_arrive') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

        <div class="col-6">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="example-number-input" class="  col-form-label">Tarre</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('tarre') ? 'is-invalid' : '' }}" name="tarre" type="number" value="{{old('tarre',$import ? $import->tarre : '')}}" id="example-number-input" step=0.01>
                    @if($errors->has('tarre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tarre') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row ">
                <div class="col-md-3">
                    <label for="example-text-input" class="col-form-label">Navire</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('navire') ? 'is-invalid' : '' }}" name="navire"  type="text" value="{{old('navire',$import ? $import->navire : '')}}" id="example-text-input">
                    @if($errors->has('navire'))
                        <div class="invalid-feedback">
                            {{ $errors->first('navire') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="example-number-input" class="col-form-label">Poid Brut</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('poid_brut') ? 'is-invalid' : '' }}" name="poid_brut" type="number" value="{{old('poid_brut',$import ? $import->poid_brut : '')}}" id="example-number-input" step=0.01>
                    @if($errors->has('poid_brut'))
                        <div class="invalid-feedback">
                            {{ $errors->first('poid_brut') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="example-number-input" class="col-form-label">Nbre Colis</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('nbr_colis') ? 'is-invalid' : '' }}" name="nbr_colis" type="number" value="{{old('nbr_colis',$import ? $import->nbr_colis : '')}}" id="example-number-input">
                    @if($errors->has('nbr_colis'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nbr_colis') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group row">
                <div class="col-md-3">
                <label for="example-number-input" class="col-form-label">Nb jour au Maroc</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('nb_jour_maroc') ? 'is-invalid' : '' }}" name="nb_jour_maroc" type="number" value="{{old('nb_jour_maroc',$import ? $import->nb_jour_maroc : '')}}" id="example-number-input" step=1>
                    @if($errors->has('nb_jour_maroc'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nb_jour_maroc') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <div class="col-md-3">
                    <label for="example-number-input" class="col-form-label">Nb jour à l'étranger</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('nb_jour_etranger') ? 'is-invalid' : '' }}" name="nb_jour_etranger" type="number" value="{{old('nb_jour_etranger',$import ? $import->nb_jour_etranger : '')}}" id="example-number-input" step=1>
                    @if($errors->has('nb_jour_etranger'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nb_jour_etranger') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <div class="col-md-3">
                <label for="example-number-input" class="col-form-label">Kilometrage</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('kilometrage') ? 'is-invalid' : '' }}" name="kilometrage" type="number" value="{{old('kilometrage',$import ? $import->kilometrage : '')}}" id="example-number-input" step=0.01>
                    @if($errors->has('kilometrage'))
                        <div class="invalid-feedback">
                            {{ $errors->first('kilometrage') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group row">
                    <div class="col-md-3">
                        <label class="col-form-label">Plomos</label>
                    </div>
                    <div class="col-md-9">
                        <select name="plomos[]" class="select2 form-control select2-multiple " multiple="multiple" data-placeholder="Choisir ...">
                                @foreach ($plomos as $plomo)

                                    <option value="{{$plomo->id}}" {{ in_array($plomo->id, old('plomos', [])) || ($import ? $import->plomos->contains($plomo->id) : null) ? 'selected' : '' }}>{{$plomo->num_serie}}</option>

                                @endforeach

                        </select>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group row">
                <div class="col-md-3">
                <label class="col-form-label" for="type">Type Chargement</label>
                </div>
                <div class="col-md-9">
                    <select class="custom-select {{ $errors->has('type_chargement') ? 'is-invalid' : '' }}" name="type_chargement" id="type_chargement">
                        @foreach(App\Import::TYPE_CHARGEMENT as $key => $label)
                            <option value="{{ $key }}" {{ old('type_chargement',$import ? $import->type_chargement : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('type_chargement'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type_chargement') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="form-group row">
                <label for="example-number-input" class="col-md-3 col-form-label">Nb jour au Maroc</label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('nb_jour_maroc') ? 'is-invalid' : '' }}" name="nb_jour_maroc" type="number" value="{{old('nb_jour_maroc',$import ? $import->nb_jour_maroc : '')}}" id="example-number-input" step=1>
                    @if($errors->has('nb_jour_maroc'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nb_jour_maroc') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row">
                <label for="example-number-input" class="col-md-3 col-form-label">Nb jour à l'étranger</label>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('nb_jour_etranger') ? 'is-invalid' : '' }}" name="nb_jour_etranger" type="number" value="{{old('nb_jour_etranger',$import ? $import->nb_jour_etranger : '')}}" id="example-number-input" step=1>
                    @if($errors->has('nb_jour_etranger'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nb_jour_etranger') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group row ">
                <div class="col-md-3">
                    <label for="example-text-input" class="col-form-label">Observation</label>
                </div>
                <div class="col-md-9">
                    <input class="form-control {{ $errors->has('observation') ? 'is-invalid' : '' }}" name="observation"  type="text" value="{{old('observation',$import ? $import->observation : '')}}" id="example-text-input">
                    @if($errors->has('observation'))
                        <div class="invalid-feedback">
                            {{ $errors->first('observation') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
</div>

</fieldset>
<h3>Import Items</h3>
<fieldset>
    <x-form-import-item  :importItem="$import ? $import : null" :clients="$clients" :transitaires="$transitaires"></x-form-import-item>
</fieldset>

<h3>Frais</h3>
<fieldset>

<x-form-personal-expenses :typeFrais="$typesFrais"  :personalExpense="$import ? $import : null"></x-form-personal-expenses>

</fieldset>

<input type="hidden" name="importItems" value="{{old('importItems')}}">

{{------------------------------------------------Modal Add external chauffeur-----------------------------------------------------------------------------------}}

<div class="modal fade modalChauffeur" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Ajouter Externe Chauffeur </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                <div class="col-6">
                    <div class="form-group row ">
                        <label for="dum" class="col-md-3 col-form-label">Matricule</label>
                        <div class="col-md-9">
                            <input class="form-control {{ $errors->has('matricule') ? 'is-invalid' : '' }}" name="matricule"  type="text"  id="matricule">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row ">
                        <label for="dum" class="col-md-3 col-form-label">Nom</label>
                        <div class="col-md-9">
                            <input class="form-control {{ $errors->has('nom') ? 'is-invalid' : '' }}" name="nom"  type="text"  id="nom">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row ">
                        <label for="dum" class="col-md-3 col-form-label">Prenom</label>
                        <div class="col-md-9">
                            <input class="form-control {{ $errors->has('prenom') ? 'is-invalid' : '' }}" name="prenom"  type="text"  id="prenom">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group row ">
                        <label for="dum" class="col-md-3 col-form-label">CIN</label>
                        <div class="col-md-9">
                            <input class="form-control {{ $errors->has('cin') ? 'is-invalid' : '' }}" name="cin"  type="text"  id="cin">
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary waves-effect waves-light saveChauffeur">Ajouter</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


{{---------------------------------------------------------------------------------------------------------------------------------------------------}}
{{-- <input type="hidden" name="personalExpenses" value="{{old('personalExpenses')}}"> --}}
<script>

    $(document).ready(function() {

        var Chauffeur, avalaibleChauffeur = [] ;
        Chauffeur = <?php echo (!empty($drivers) ?  $drivers : ''); ?>;
        Chauffeur.forEach(element => {
            avalaibleChauffeur.push(element.nom+" "+element.prenom+"("+element.cin+")");
        });

        var type = $('#type').find(":selected").text();
        var genreSelected = $('#genre').find(":selected").val();
        if(genreSelected == 'interne'){
            $('#vehic').show();
        }
        else{
            $('#vehic').hide();
        }
        $('#type').change(function () {
            var typeSelected = $(this).children("option:selected").val();
            var genreSelected = $('#genre').find(":selected").val();
            if(genreSelected == 'interne'){
                $.ajax({
                    url:'{{route('import.create')}}',
                    type:'get',
                    data: {type:typeSelected},

                    success: function (response) {
                        $('#vehicle').html(response.btn);
                        $('#vehic').show();
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            }else{
                $('#vehic').hide();
            }

        });

        $('#genre').change(function () {
            var genreSelected = $(this).children("option:selected").val();
            var typeSelected = $('#type').find(":selected").val();
            if(genreSelected == 'interne'){
                $.ajax({
                    url:'{{route('import.create')}}',
                    type:'get',
                    data: {type:typeSelected},

                    success: function (response) {
                        $('#vehicle').html(response.btn);
                        $('#vehic').show();
                    },
                    error:function(err){
                        console.log(err)
                    }
                });
            }else{
                $('#vehic').hide();
            }
        });

        $('.driverInfo').on("focus", function(){
            $(this).autocomplete({
                source: avalaibleChauffeur
            });
        });
    });

    $(".saveChauffeur").click(function(){

        let matricule = $("input[name=matricule]").val();
        let nom = $("input[name=nom]").val();
        let prenom = $("input[name=prenom]").val();
        let cin = $("input[name=cin]").val();

        if(nom == '' || prenom == '' || cin == ''){
            alert('Remplire les champs obligatoire (Nom,Prenom,Cin)')
            return;
        }
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
        url: "/person/addExternalPerson",
        type:"POST",
        data:{
          matricule:matricule,
          nom:nom,
          prenom:prenom,
          cin:cin,
          _token: _token
        },
        success:function(response){
          if(response) {
            $('#chauffeurs').append(response.data)

            $('.modalChauffeur').modal('toggle');
            $("input[name=matricule]").val('');
            $("input[name=nom]").val('');
            $("input[name=prenom]").val('');
            $("input[name=cin]").val('');

          }
        },
        error: function(error) {
            alert('refaire cette action aprés')

        }
       });

    });


</script>
<script src="{{asset('libs/select2/select2.min.js')}}"></script>
<script src="{{asset('js/pages/form-advanced.init.js')}}"></script>













