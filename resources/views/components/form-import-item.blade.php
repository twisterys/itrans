<div class="row">
    <div class="col-11">
        <div class="table-responsive" style="width:100%; height:200px; overflow:auto;">
            <table class="table table-striped mb-0" >

                <thead>
                    <tr>
                        <th>Client</th>
                        <th>Importateur</th>
                        <th>Exportateur</th>
                        <th>Transitaire</th>
                        <th>Marchandise</th>
                        <th>Dum</th>
                        <th>Nbre de Colis</th>
                        <th>Poids Brut</th>
                        <th>Observation</th>
                    </tr>
                </thead>

                    <tbody id="importIt">

                    </tbody>


            </table>
        </div>
    </div>

    <div class="col-1">
        <div class="mt-5">
            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target=".modalImportItem">Nouveau</button>
        </div>
    </div>
    <div class="modal fade modalImportItem" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Fiche Détail </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden"value="" name="inx" id="inx">
                    <div class="col-11">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label ">Client<span class="text-danger">*</span> </label>
                            <div class="col-md-9">
                                <select class="form-control select2  {{ $errors->has('client_id') ? 'is-invalid' : '' }}" id="client_id" name="client_id" style="width: 100%;">
                                    <option value="" selected>Open this select menu</option>
                                    @foreach($clients as $label)
                                        <option value="{{ $label->id }}" {{ old('client_id', $importItem ? $importItem->client_id : '') ==  $label->id ? 'selected' : '' }}>{{ $label->nom }}</option>
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
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="importateur" class="col-md-3 col-form-label">Importateur<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('importateur') ? 'is-invalid' : '' }}" name="importateur"  type="text" value="{{old('importateur',$importItem ? $importItem->importateur : '')}}" id="importateur">
                                @if($errors->has('importateur'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('importateur') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="exportateur" class="col-md-3 col-form-label">Exportateur<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea class="form-control {{ $errors->has('exportateur') ? 'is-invalid' : '' }}" name="exportateur" value="{{old('exportateur',$importItem ? $importItem->exportateur : '')}}" rows="3" id="exportateur"></textarea>
                                @if($errors->has('exportateur'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('exportateur') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Transitaire<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control select2  {{ $errors->has('transitaire_id') ? 'is-invalid' : '' }}" id="transitaire_id" name="transitaire_id" style="width: 100%;">
                                    <option selected>Open this select menu</option>
                                    @foreach($transitaires as $label)
                                        <option value="{{ $label->id }}" {{ old('transitaire_id', $importItem ? $importItem->transitaire_id : '') ==  $label->id ? 'selected' : '' }}>{{ $label->nom }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('transitaire_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('transitaire_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="marchandise" class="col-md-3 col-form-label">Marchandise<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('marchandise') ? 'is-invalid' : '' }}" name="marchandise"  type="text" value="{{old('marchandise',$importItem ? $importItem->marchandise : '')}}" id="marchandise">
                                @if($errors->has('marchandise'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('marchandise') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="dum" class="col-md-3 col-form-label">D.U.M<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('dum') ? 'is-invalid' : '' }}" name="dum"  type="text" value="{{old('dum',$importItem ? $importItem->dum : '')}}" id="dum">
                                @if($errors->has('dum'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('dum') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row">
                            <label for="numb_colis" class="col-md-3 col-form-label">Nbre Colis<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('numb_colis') ? 'is-invalid' : '' }}" name="numb_colis" type="number" value="{{old('numb_colis',$importItem ? $importItem->numb_colis : '')}}" id="numb_colis">
                                @if($errors->has('numb_colis'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('numb_colis') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row">
                            <label for="poid_brute" class="col-md-3 col-form-label">Poids Brut<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('poid_brute') ? 'is-invalid' : '' }}" name="poid_brute" type="number" value="{{old('poid_brute',$importItem ? $importItem->poid_brute : '')}}" id="poid_brute" step=0.01>
                                @if($errors->has('poid_brute'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('poid_brute') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="observ" class="col-md-3 col-form-label">Observation<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea class="form-control {{ $errors->has('observ') ? 'is-invalid' : '' }}" name="observ" value="{{old('observ',$importItem ? $importItem->observ : '')}}" rows="3" id="observ"></textarea>
                                @if($errors->has('observ'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('observ') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light saveImportItem">Ajouter</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    {{---------------------------------------- Modifier import dossier ---------------------------------}}

    <div class="modal fade modalModifyImportItem" id="modifModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Modifier Fiche Détail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="importItem_id" id="importItem_id">
                    <input type="hidden"value="" name="inx" id="inx">
                    <div class="col-11">
                        <div class="form-group row">
                            <label for="client_id1" class="col-md-3 col-form-label">Client</label>
                            <div class="col-md-9">
                                <select class="form-control select2  {{ $errors->has('client_id') ? 'is-invalid' : '' }}" id="client_id1" name="client_id1" style="width: 100%;">
                                    <option value="" selected>Open this select menu</option>
                                    @foreach($clients as $label)
                                        <option value="{{ $label->id }}" {{ old('client_id', $importItem ? $importItem->client_id : '') ==  $label->id ? 'selected' : '' }}>{{ $label->nom }}</option>
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
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="importateur1" class="col-md-3 col-form-label">Importateur</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('importateur') ? 'is-invalid' : '' }}" name="importateur1"  type="text" value="{{old('importateur',$importItem ? $importItem->importateur : '')}}" id="importateur1">
                                @if($errors->has('importateur'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('importateur') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="exportateur1" class="col-md-3 col-form-label">Exportateur</label>
                            <div class="col-md-9">
                                <textarea class="form-control {{ $errors->has('exportateur') ? 'is-invalid' : '' }}" name="exportateur1" value="{{old('exportateur',$importItem ? $importItem->exportateur : '')}}" rows="3" id="exportateur1"></textarea>
                                @if($errors->has('exportateur'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('exportateur') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Transitaire</label>
                            <div class="col-md-9">
                                <select class="form-control select2  {{ $errors->has('transitaire_id') ? 'is-invalid' : '' }}" id="transitaire_id1" name="transitaire_id1" style="width: 100%;">
                                    <option selected>Open this select menu</option>
                                    @foreach($transitaires as $label)
                                        <option value="{{ $label->id }}" {{ old('transitaire_id', $importItem ? $importItem->transitaire_id : '') ==  $label->id ? 'selected' : '' }}>{{ $label->nom }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('transitaire_id'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('transitaire_id') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="marchandise1" class="col-md-3 col-form-label">Marchandise</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('marchandise') ? 'is-invalid' : '' }}" name="marchandise1"  type="text" value="{{old('marchandise',$importItem ? $importItem->marchandise : '')}}" id="marchandise1">
                                @if($errors->has('marchandise'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('marchandise') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="dum" class="col-md-3 col-form-label">D.U.M</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('dum') ? 'is-invalid' : '' }}" name="dum1"  type="text" value="{{old('dum',$importItem ? $importItem->dum : '')}}" id="dum1">
                                @if($errors->has('dum'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('dum') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row">
                            <label for="numb_colis1" class="col-md-3 col-form-label">Nbre Colis</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('numb_colis') ? 'is-invalid' : '' }}" name="numb_colis1" type="number" value="{{old('numb_colis',$importItem ? $importItem->numb_colis : '')}}" id="numb_colis1">
                                @if($errors->has('numb_colis'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('numb_colis') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row">
                            <label for="poid_brute1" class="col-md-3 col-form-label">Poids Brut</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('poid_brute') ? 'is-invalid' : '' }}" name="poid_brute1" type="number" value="{{old('poid_brute',$importItem ? $importItem->poid_brute : '')}}" id="poid_brute1" step=0.01>
                                @if($errors->has('poid_brute'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('poid_brute') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="observ1" class="col-md-3 col-form-label">Observation</label>
                            <div class="col-md-9">
                                <textarea class="form-control {{ $errors->has('observ') ? 'is-invalid' : '' }}" name="observ1" value="{{old('observ',$importItem ? $importItem->observ : '')}}" rows="3" id="observ1"></textarea>
                                @if($errors->has('observ'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('observ') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light modifImportItem">Modifier</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

{{---------------------------------------- END Modifier import dossier ---------------------------------}}






</div>
<script>
    function deleteItem(index){
        swal.fire({
            title: "Supprimé?",
            icon: 'question',
            text: "",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Oui, Supprimer!",
            cancelButtonText: "Non, annuler!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                total.splice(index,1);
                $("tbody#importIt").empty();
                total.forEach(function (element, i) {
                    if(element.hasOwnProperty('client_name')){
                        $('tbody#importIt').append("<tr><td>"+element['client_name']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire_name']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                    }
                    else if(element['transitaire'] == null || element['client'] == null){
                        $('tbody#importIt').append("<tr><td>"+element['client']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                    }
                    else{
                        $('tbody#importIt').append("<tr><td>"+element['client']['nom']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']['nom']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                    }
                });
                $('input[name=importItems]').val(JSON.stringify(total));
            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        });
    }

    function modifyItem(index){

        //console.log(total[index])
        $('input[name=inx]').val(index)
        $("#importItem_id").val(total[index]['id'])
        if(total[index].hasOwnProperty('client_name')){

            $("#client_id1").val(total[index]['client']).change();
        }else if(total[index]['client'] == null){
            console.log(total[index])
        }else{
            $("#client_id1").val(total[index]['client']['id']).change();
        }

        if(total[index].hasOwnProperty('transitaire_name')){

            $("#transitaire_id1").val(total[index]['transitaire']).change();
        }else if(total[index]['transitaire'] == null){

        }else{

            $("#transitaire_id1").val(total[index]['transitaire']['id']).change();
        }

        $('input[name=importateur1]').val(total[index]['importateur'])
        $("#exportateur1").val(total[index]['exportateur']);
        //$('input[name=transitaire1]').val(total[index]['transitaire'])
        $('input[name=marchandise1]').val(total[index]['marchandise'])
        $('input[name=dum1]').val(total[index]['dum'])
        $('input[name=numb_colis1]').val(total[index]['numb_colis'])
        $('input[name=poid_brute1]').val(total[index]['poid_brute'])
        $("#observ1").val(total[index]['observ']);
        $('.modalModifyImportItem').modal();
        //console.log($('input[name=inx]').val())
    }
</script>
<script>


    var total = new Array();
    total = $('input[name=importItems]').val()
    $(document).ready(function() {

        if(total){
            total = JSON.parse(total)
        }
        else{
            total = <?php echo (!empty($importItem) ?  json_encode($importItem->dossierItems) : 'new Array()'); ?>
        }

        console.log(total)
        total.forEach(function (element, i) {
            if(element.hasOwnProperty('client_name') && element.hasOwnProperty('transitaire_name')){

                $('tbody#importIt').append("<tr><td>"+element['client_name']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire_name']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
            }
            else if(element['transitaire'] == null && element['client'] != null){
                $('tbody#importIt').append("<tr><td>"+element['client']['nom']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
            }
            else if(element['transitaire'] != null && element['client'] == null){
                $('tbody#importIt').append("<tr><td>"+element['client']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']['nom']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
            }
            else{

                $('tbody#importIt').append("<tr><td>"+element['client']['nom']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']['nom']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
            }
        });

        $('input[name=importItems]').val(JSON.stringify(total));




        $(".saveImportItem").click(function(){
            if($('input[name=importateur]').val() == "" || $("#exportateur").val() == "" ||  $('input[name=marchandise]').val() == "" || $('input[name=dum]').val() == "" || $('input[name=numb_colis]').val() == "" || $('input[name=poid_brute]').val() == "" || $("select[name=client_id]").val() == "" ){
                alert('Veuillez Remplir les champs obligatoires')
                return;
            }
            $("tbody#importIt").empty();
            const item = {
            id: null,
            type: $('input[name="type2"]:checked').val(),
            client:$("#client_id").val(),
            client_name:$("#client_id option:selected").text(),
            importateur:document.getElementById("importateur").value,
            exportateur:document.getElementById("exportateur").value,
            transitaire:$("#transitaire_id").val(),
            transitaire_name:$("#transitaire_id option:selected").text(),
            marchandise:document.getElementById("marchandise").value,
            dum:document.getElementById("dum").value,
            numb_colis: document.getElementById("numb_colis").value,
            poid_brute: document.getElementById("poid_brute").value,
            observ: document.getElementById("observ").value,
            };



             total.push(item)
             //console.log(total);
             total.forEach(function (element, i) {
                if(element['id'] == null || element['id'] == ''){
                    $('tbody#importIt').append("<tr><td>"+element['client_name']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire_name']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                }
                else if(element['transitaire'] == null && element['client'] != null){
                    $('tbody#importIt').append("<tr><td>"+element['client']['nom']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                }
                else if(element['transitaire'] != null && element['client'] == null){
                    $('tbody#importIt').append("<tr><td>"+element['client']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']['nom']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                }
                else{
                    $('tbody#importIt').append("<tr><td>"+element['client']['nom']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']['nom']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                }
             });
             $('input[name=importItems]').val(JSON.stringify(total));


             $(".modalImportItem").modal('hide');
             $("select[name=client_id]").val('').change();
             $('input[name=client]').val('')
             $('input[name=importateur]').val('')
             $("#exportateur").val('');
             $("select[name=transitaire_id]").val('').change();
             $('input[name=transitaire]').val('')
             $('input[name=marchandise]').val('')
             $('input[name=dum]').val('')
             $('input[name=numb_colis]').val('')
             $('input[name=poid_brute]').val('')
             $("#observ").val('');

        });
        $(".modifImportItem").click(function(){
            if($('input[name=importateur1]').val() == "" || $("#exportateur1").val() == "" || $('input[name=marchandise1]').val() == "" || $('input[name=dum1]').val() == "" || $('input[name=numb_colis1]').val() == "" || $('input[name=poid_brute1]').val() == "" || $("select[name=client_id1]").val() == ""){
                alert('Veuillez Remplire les champs')
                return;
            }
            let v =$('input[name=inx]').val()

            total.splice(v,1);

            const item = {
            id: $("#importItem_id").val(),
            type: $('input[name="type2"]:checked').val(),
            client:$("#client_id1").val(),
            client_name:$("#client_id1 option:selected").text(),
            importateur:document.getElementById("importateur1").value,
            exportateur:document.getElementById("exportateur1").value,
            transitaire:$("#transitaire_id1").val(),
            transitaire_name:$("#transitaire_id1 option:selected").text(),
            marchandise:document.getElementById("marchandise1").value,
            dum:document.getElementById("dum1").value,
            numb_colis: document.getElementById("numb_colis1").value,
            poid_brute: document.getElementById("poid_brute1").value,
            observ: document.getElementById("observ1").value,
            };
            //console.log(item)
            total.splice(v, 0, item);
            //total.push(item)
            console.log(total)
            $("tbody#importIt").empty();
                total.forEach(function (element, i) {

                    if(element.hasOwnProperty('client_name')){

                        $('tbody#importIt').append("<tr><td>"+element['client_name']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire_name']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                    }
                    else if(element['transitaire'] == null && element['client'] != null){
                        $('tbody#importIt').append("<tr><td>"+element['client']['nom']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                    }
                    else if(element['transitaire'] != null && element['client'] == null){
                        $('tbody#importIt').append("<tr><td>"+element['client']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']['nom']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                    }
                    else{

                        $('tbody#importIt').append("<tr><td>"+element['client']['nom']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']['nom']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' data-toggle='tooltip' title='Modifier' onClick='modifyItem("+i+");' class='btn btn-warning mr-1 btn-sm waves-effect waves-light' data-toggle='modal' data-target='.modalModifyImportItem'><i class='bx bx-edit-alt'></i></button><button type='button' data-toggle='tooltip' title='Supprimer' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
                    }


            });
            $('input[name=importItems]').val(JSON.stringify(total));

            $('#modifModal').modal('hide');
        });
    });

</script>

