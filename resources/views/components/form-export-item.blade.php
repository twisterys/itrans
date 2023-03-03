<div class="row">
    <div class="col-11">
        <div class="table-responsive" style="width:100%; height:200px; overflow:auto;">
            <table class="table table-striped mb-0" >

                <thead>
                    <tr>
                        <th>Type</th>
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
                @if ($exportItem)
                <tbody>
                    
                </tbody>
                @else
                    <tbody>
                    
                    </tbody>
                @endif

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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Fiche Détail Export</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-11">
                        <div class="card bg-secondary">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="type A" name="type2" value="type A" class="custom-control-input type" checked>
                                                    <label class="custom-control-label text-dark" for="type A">Type A</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mt-4 mt-lg-0">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="type B" name="type2" value="type B" class="custom-control-input type">
                                                    <label class="custom-control-label text-dark" for="type B">Type B</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="client" class="col-md-3 col-form-label">Client</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('client') ? 'is-invalid' : '' }}" name="client"  type="text" value="{{old('client',$exportItem ? $exportItem->client : '')}}" id="client" >
                                @if($errors->has('client'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('client') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="importateur" class="col-md-3 col-form-label">Importateur</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('importateur') ? 'is-invalid' : '' }}" name="importateur"  type="text" value="{{old('importateur',$exportItem ? $exportItem->importateur : '')}}" id="importateur">
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
                            <label for="exportateur" class="col-md-3 col-form-label">Exportateur</label>
                            <div class="col-md-9">
                                <textarea class="form-control {{ $errors->has('exportateur') ? 'is-invalid' : '' }}" name="exportateur" value="{{old('exportateur',$exportItem ? $exportItem->exportateur : '')}}" rows="3" id="exportateur"></textarea>
                                @if($errors->has('exportateur'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('exportateur') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="transitaire" class="col-md-3 col-form-label">Transitaire</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('transitaire') ? 'is-invalid' : '' }}" name="transitaire"  type="text" value="{{old('transitaire',$exportItem ? $exportItem->transitaire : '')}}" id="transitaire">
                                @if($errors->has('transitaire'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('transitaire') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group row ">
                            <label for="marchandise" class="col-md-3 col-form-label">Marchandise</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('marchandise') ? 'is-invalid' : '' }}" name="marchandise"  type="text" value="{{old('marchandise',$exportItem ? $exportItem->marchandise : '')}}" id="marchandise">
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
                                <input class="form-control {{ $errors->has('dum') ? 'is-invalid' : '' }}" name="dum"  type="text" value="{{old('dum',$exportItem ? $exportItem->dum : '')}}" id="dum">
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
                            <label for="numb_colis" class="col-md-3 col-form-label">Nbre Colis</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('numb_colis') ? 'is-invalid' : '' }}" name="numb_colis" type="number" value="{{old('numb_colis',$exportItem ? $exportItem->numb_colis : '')}}" id="numb_colis">
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
                            <label for="poid_brute" class="col-md-3 col-form-label">Poids Brut</label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('poid_brute') ? 'is-invalid' : '' }}" name="poid_brute" type="number" value="{{old('poid_brute',$exportItem ? $exportItem->poid_brute : '')}}" id="poid_brute" step=0.01>
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
                            <label for="observ" class="col-md-3 col-form-label">Observation</label>
                            <div class="col-md-9">
                                <textarea class="form-control {{ $errors->has('observ') ? 'is-invalid' : '' }}" name="observ" value="{{old('observ',$exportItem ? $exportItem->observ : '')}}" rows="3" id="observ"></textarea>
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
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light saveImportItem">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>





</div>
<script>
    function deleteItem(index){
        if (confirm("Are you sure?")) {
            total.splice(index,1);
            $("tbody").empty();
            total.forEach(function (element, i) {
                    $('tbody').append("<tr><td>"+element['type']+"</td><td>"+element['client']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
            });

            $('input[name=exportItems]').val(JSON.stringify(total));
            
        }
        return false;  
    }
</script>
@section('script')
<script>
    
    var total = new Array();
    total = $('input[name=exportItems]').val()
    $(document).ready(function() {
        
        if(total){ 
            total = JSON.parse(total)
        }else{
            total = <?php echo (!empty($exportItem) ?  json_encode($exportItem->exportItems) : 'new Array()'); ?>
        }
       
       
        total.forEach(function (element, i) {
                $('tbody').append("<tr><td>"+element['type']+"</td><td>"+element['client']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
        });

        $('input[name=exportItems]').val(JSON.stringify(total));
        



        $(".saveImportItem").click(function(){
            if($('input[name=client]').val() == "" || $('input[name=importateur]').val() == "" || $("#exportateur").val() == "" || $('input[name=transitaire]').val() == "" || $('input[name=marchandise]').val() == "" || $('input[name=dum]').val() == "" || $('input[name=numb_colis]').val() == "" || $('input[name=poid_brute]').val() == ""){
                alert('Veuillez Remplire les champs')
                return;
            }
            $("tbody").empty();
            const item = {
            id: null,
            type: $('input[name="type2"]:checked').val(),
            client:document.getElementById("client").value,
            importateur:document.getElementById("importateur").value,
            exportateur:document.getElementById("exportateur").value,
            transitaire:document.getElementById("transitaire").value,
            marchandise:document.getElementById("marchandise").value,
            dum:document.getElementById("dum").value,
            numb_colis: document.getElementById("numb_colis").value,
            poid_brute: document.getElementById("poid_brute").value,
            observ: document.getElementById("observ").value,
            };
            
            
             total.push(item)
             total.forEach(function (element, i) {
                $('tbody').append("<tr><td>"+element['type']+"</td><td>"+element['client']+"</td><td>"+element['importateur']+"</td><td>"+element['exportateur']+"</td><td>"+element['transitaire']+"</td><td>"+element['marchandise']+"</td><td>"+element['dum']+"</td><td>"+element['numb_colis']+"</td><td>"+element['poid_brute']+"</td><td>"+element['observ']+"</td><td><button type='button' onClick='deleteItem("+i+");' class='btn btn-danger btn-sm delete'><i class='mdi mdi-delete-alert-outline'></i></button></td></tr>")
             });

             $('input[name=exportItems]').val(JSON.stringify(total));

             
            
             $(".modalImportItem").modal('hide');
             $('input[name=client]').val('')
             $('input[name=importateur]').val('')
             $("#exportateur").val('');
             $('input[name=transitaire]').val('')
             $('input[name=marchandise]').val('')
             $('input[name=dum]').val('')
             $('input[name=numb_colis]').val('')
             $('input[name=poid_brute]').val('')
             $("#observ").val('');
            
        });

    });

</script>


@endsection
