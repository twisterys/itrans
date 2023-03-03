<div class="row">
    <div class="col-6">
        <div class="form-group row">
            <label for="example-date-input" class="col-md-3 col-form-label">Date<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('date') ? 'is-invalid' : '' }}" name="date" type="date" value="{{old('date',$gasoil ? $gasoil->date : '')}}" id="example-date-input">
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row mb-0">
            <label class="col-md-3 col-form-label">Station<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <select class="form-control select2 {{ $errors->has('station') ? 'is-invalid' : '' }}" name="station">
                    <option value="" selected>Open this select menu</option>
                    @foreach($stations as $label)
                        <option value="{{ $label->id }}" {{ old('station', $gasoil ? $gasoil->station_id : '') === $label->id ? 'selected' : '' }}>{{ $label->nom.'('.$label->ville.')' }}</option>
                    @endforeach
                </select>
                @if($errors->has('station'))
                    <div class="invalid-feedback">
                        {{ $errors->first('station') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="col-6">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-3 col-form-label">Kilometrage<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('kilometrage') ? 'is-invalid' : '' }}" name="kilometrage" type="number" value="{{old('kilometrage',$gasoil ? $gasoil->kilometrage : '')}}" id="example-number-input" step=0.01>
                @if($errors->has('kilometrage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('kilometrage') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row mb-0">
            <label class="col-md-3 col-form-label">Chauffeur<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <select class="form-control select2 {{ $errors->has('chauffeur') ? 'is-invalid' : '' }}" name="chauffeur">
                    <option value="" selected>Open this select menu</option>
                    @foreach($drivers as $key => $label)
                        <option value="{{ $label->id }}" {{ old('chauffeur', $gasoil ? $gasoil->chauffeur_id : '') === $label->id ? 'selected' : '' }}>{{ $label->nom.' '.$label->prenom.'('.$label->cin.')' }}</option>
                    @endforeach
                </select>
                @if($errors->has('chauffeur'))
                    <div class="invalid-feedback">
                        {{ $errors->first('chauffeur') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group row ">
            <label for="vehicleInfo" class="col-md-3 col-form-label">Matricule<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control vehicle vehicleInfo {{ $errors->has('vehicle') ? 'is-invalid' : '' }}" type="text" name="vehicle" id="matriculeVehicle" value="{{old('vehicle',$gasoil ? $gasoil->vehicle : '')}}" id="vehicleInfo">
                @if($errors->has('vehicle'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vehicle') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group row">
            <label for="example-number-input" class="col-md-3 col-form-label">Prix<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('prix') ? 'is-invalid' : '' }}" name="prix" type="number" value="{{old('prix',$gasoil ? $gasoil->prix : '')}}" id="example-number-input" step=0.01>
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
            <label for="example-number-input" class="col-md-3 col-form-label">Quantité<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
            <div class="col-md-9">
                <input class="form-control {{ $errors->has('qte') ? 'is-invalid' : '' }}" name="qte" type="number" value="{{old('qte',$gasoil ? $gasoil->qte : '')}}" id="example-number-input" step=1>
                @if($errors->has('qte'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qte') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="mt-3 float-right">
    <button type="submit" class="btn btn-info">{{$slot}}</button>
</div>

@section('script')
<script src="{{ asset('libs/jquery-ui/jquery-ui.min.js')}}"></script>
<script src="{{ asset('libs/select2/select2.min.js')}}"></script>
<script src="{{asset('js/pages/form-advanced.init.js')}}"></script>
<script>

    $(document).ready(function() {

            var Chauffeur, avalaibleChauffeur = [] ;
            var Station , availableStation = [];
            var vehicles = <?php echo (!empty($vehicles) ? $vehicles : ''); ?>;
        
            Chauffeur = <?php echo (!empty($drivers) ?  $drivers : ''); ?>;
            Chauffeur.forEach(element => {
                avalaibleChauffeur.push(element.nom+" "+element.prenom+"("+element.cin+")");
            });

            Station = <?php echo (!empty($stations) ?  $stations : ''); ?>;
            Station.forEach(element => {
                availableStation.push(element.nom+"("+element.ville+")");
            });

            $('.stationInfo').on("focus", function(){
                $(this).autocomplete({
                    source: availableStation
                });
            });

            $('.driverInfo').on("focus", function(){
                $(this).autocomplete({
                    source: avalaibleChauffeur
                });
            });
            $('.vehicleInfo').on("focus", function(){
                $(this).autocomplete({
                    source: vehicles
                });
            });

    });

    // $('.driverInfo').on("focus", function(){
    //     $(this).autocomplete({
    //         source: avalaibleChauffeur
    //     });
    // });
    // $('.driverInfo').on("focus", function(){
    //     $(this).autocomplete({
    //         source: avalaibleChauffeur
    //     });
    // });
</script>
@endsection
