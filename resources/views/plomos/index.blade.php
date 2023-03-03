@extends('layouts.master-layouts')

@section('title') Plomos @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>

@endsection
@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Plomos  @endslot
         @slot('action')<a href="{{route('plomos.rapport')}}" class="btn btn-success ">Télécharger Rapport </a>  <button type="button" data-toggle="modal" data-target=".modalAddPlomo" class="btn btn-success ">Nouveau plomo </button>    @endslot
         @slot('action')<button type="button" data-toggle="modal" data-target=".modalAddPlomo" class="btn btn-success ">Nouveau plomo </button>    @endslot
     @endcomponent

                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-md-12">

                        </div>
                        <div class="col-lg-6">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>
                                    <table id="datatable-buttons" class="table table-bordered data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>

                                                <th>ID</th>
                                                <th>Numéro Série</th>
                                                <th>Utilisation</th>
                                                <th>Prêter de</th>
                                                <th>Prêter pour</th>
                                                <th>Etat</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

{{------------------------------------------------Modal Add Plomo-----------------------------------------------------------------------------------}}

<div class="modal fade modalAddPlomo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Ajouter Plomo </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('plomos.store')}}">
                    @csrf
                    <div class="row">
                    <div class="col-10">
                        <div class="">
                            <div class="row custom-radio">
                                <label for="example-text-input" class="col-md-4 col-form-label">Type</label>
                                <div class="col-4 mt-2">
                                    <input type="radio" id="customRadio1" value=0 name="type" class="custom-control-input"   checked>
                                    <label class="custom-control-label" for="customRadio1">Série Douane</label>
                                </div>
                                <div class="col-4 mt-2">
                                    <input type="radio" id="customRadio2" value=1 name="type" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio2">Autre fournisseur</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 from">
                        <div class="form-group row ">
                            <label for="dum" class="col-md-3 col-form-label">Debut série<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('from') ? 'is-invalid' : '' }}" name="from"  type="text"  id="from">
                            </div>
                        </div>
                    </div>
                    <div class="col-10 to">
                        <div class="form-group row ">
                            <label for="dum" class="col-md-3 col-form-label">Fin Série<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('to') ? 'is-invalid' : '' }}" name="to"  type="text"  id="to">
                            </div>
                        </div>
                    </div>

                    <div class="col-10 traiter_de">
                        <div class="form-group row">
                            <label for="dum" class="col-md-3 col-form-label">Numero série<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('num_serie') ? 'is-invalid' : '' }}" name="num_serie"  type="text"  id="num_serie">
                            </div>
                        </div>
                    </div>
                    <div class="col-10 traiter_de">
                        <div class="form-group row ">
                            <label for="dum" class="col-md-3 col-form-label">Note<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('traiter_de') ? 'is-invalid' : '' }}" name="traiter_de"  type="text"  id="traiter_de">
                            </div>
                        </div>
                    </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light saveChauffeur">Ajouter</button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


{{---------------------------------------------------------------------------------------------------------------------------------------------------}}


{{------------------------------------------------Modal Sortant-----------------------------------------------------------------------------------}}

<div class="modal fade modalSortant" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myLargeModalLabel">Sortant </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="row">
                    <input type="hidden" name="idPlomos" value="">
                    <div class="col-10">
                        <div class="">
                            <div class="row custom-radio">
                                <label for="example-text-input" class="col-md-4 col-form-label">Type</label>
                                <div class="col-4 mt-2">
                                    <input type="radio" id="customRadio8" value=0 name="type2" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="customRadio8">Défaillance</label>
                                </div>
                                <div class="col-4 mt-2">
                                    <input type="radio" id="customRadio9" value=1 name="type2" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio9">Prêter pour</label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-10 traiter_a">
                        <div class="form-group row ">
                            <label for="dum" class="col-md-3 col-form-label">Prêter Pour<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                            <div class="col-md-9">
                                <input class="form-control {{ $errors->has('traiter_a') ? 'is-invalid' : '' }}" name="traiter_a"  type="text"  id="traiter_a">
                            </div>
                        </div>
                    </div>

                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Fermer</button>
                <button type="button" class="btn btn-primary waves-effect waves-light saveSortantPlomos">Ajouter</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{---------------------------------------------------------------------------------------------------------------------------------------------------}}

@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $( ".traiter_de" ).hide()
            $( ".traiter_a" ).hide()

          var table = $('#datatable-buttons').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('plomos.index') }}",
              columns: [

                  {data: 'id', name: 'id'},
                  {data: 'num_serie', name: 'num_serie'},
                  {data: 'utilisation', name: 'utilisation'},
                  {data: 'traiter_de', name: 'traiter_de'},
                  {data: 'traiter_a', name: 'traiter_a'},
                  {data: 'defaillante', name: 'defaillante'},
                  {data: 'actions', name: 'actions', orderable: false, searchable: false},
              ],
              orderCellsTop: true,
            order: [[ 0, 'desc' ]],
            pageLength: 50
          });

          $('.data-table thead').on('input', '.search', function () {
                let strict = $(this).attr('strict') || false
                let value = strict && this.value ? "^" + this.value + "$" : this.value

                let index = $(this).parent().index()
                table.column(index).search(value, strict).draw()

            });


        });

        $('form').submit(function () {
            if($("input[name=type]:checked").val() == '0'){
                var from = $( "input[name=from]" ).val()
                var to = $( "input[name=to]" ).val()
                if(from == '' || to == ''){
                    alert('remplire tous les champs')
                    return false;
                }
                if( + to < + from ){
                    alert('Fin série doit étre égale ou supérieur de debut de série')
                    return false;
                }
                if( (+ to - + from) > 200 ){
                    alert('La série ne doit pas dépasser 200')
                    return false;
                }
            }else{
                var num_serie = $( "input[name=num_serie]" ).val()
                var note = $( "input[name=traiter_de]" ).val()
                if(num_serie == '' || note == ''){
                    alert('remplire tous les champs')
                    return false;
                }
            }
        });

        $( "input[name=type]" ).change(function() {
                switch($(this).val()) {
                    case '0' :
                    $( "input[name=traiter_de]" ).val('')
                    $( "input[name=num_serie]" ).val('')
                    $( "input[name=from]" ).val('')
                    $( "input[name=to]" ).val('')

                    $( ".from" ).show()
                    $( ".to" ).show()
                    $( ".traiter_de" ).hide()
                        break;
                    case '1' :
                        $( "input[name=traiter_de]" ).val('')
                        $( "input[name=num_serie]" ).val('')
                        $( "input[name=from]" ).val('')
                        $( "input[name=to]" ).val('')
                        $( ".from" ).hide()
                        $( ".to" ).hide()
                        $( ".traiter_de" ).show()
                    break;
                }
            });

            $( "input[name=type2]" ).change(function() {
                switch($(this).val()) {
                    case '0' :
                        $( "input[name=traiter_a]" ).val('')
                        $( ".traiter_a" ).hide()
                        break;
                    case '1' :
                        $( "input[name=traiter_a]" ).val('')
                        $( ".traiter_a" ).show()
                    break;
                }
            });



            $(".saveSortantPlomos").click(function(){



                let id = $("input[name=idPlomos]").val();
                let type = $("input[name=type2]:checked").val();
                let traiter_a = $( "input[name=traiter_a]" ).val();
                let _token   = $('meta[name="csrf-token"]').attr('content');

                if(type == '1' && traiter_a == ''){
                    alert('Le champs traiter pour est obligatoire')
                    return false;
                }


                $.ajax({
                    url: "/plomos/sortant/"+id,
                    type:"PUT",
                    data:{
                      type:type,
                      traiter_a:traiter_a,
                      _token: _token
                    },
                    success:function(response){
                      if(response) {
                        $( "input[name=traiter_a]" ).val('')
                        location.reload();
                      }
                    },
                    error: function(error) {
                        alert('refaire cette action aprés')

                    }
                });

            });
            function sortantPlomos(id){
                $("input[name=idPlomos]").val(id);
            }



        function deletePlomo(id){
            swal.fire({
            title: "Supprimé?",
            icon: 'question',
            text: "Voulez vous vraiment le supprimer!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Oui, Supprimer!",
            cancelButtonText: "Non, annuler!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                //alert('hi');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = '{{ route("plomos.destroy", ":plomo") }}';
                url = url.replace(':plomo', id);
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {

                            location.reload();
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
      </script>
@endsection
