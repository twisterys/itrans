@extends('layouts.master-layouts')

@section('title') Imports @endsection
@section('css')
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>
    <style>
        .left-col{
            display: inline;
        }
    </style>
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Dossier d'imports  @endslot
         @slot('action')  <a class="btn btn-success " href="{{route('import.create')}}">Nouveau dossier </a>    @endslot
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
                                    <table id="datatable-buttons" class="table table-responsive table-bordered data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date</th>
                                                <th>BL N°</th>
                                                <th style="width: 100px">Chauffeur</th>
                                                <th>Véhicules</th>
                                                <th>Provenance</th>
                                                <th>Destination</th>
                                                <th>Client</th>
                                                <th> </th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input type="month" class="search" style="width: 50%;">
                                                </td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px"></td>
                                                <td></td>
                                            </tr>
                                        </thead>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection
@section('script')


    <script type="text/javascript">
        //let dtButtons = $.extend(true, [], $.fn.dataTable)
        $(function () {

          var table = $('#datatable-buttons').DataTable({

          dom: 'lBfrtip',

          buttons: [
            {
              extend: 'copy',
              className: 'btn-default',
              text: 'Copier',
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'csv',
              className: 'btn-default',
              text: 'CSV',
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'excel',
              className: 'btn-default',
              text: 'Excel',
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'pdf',
              className: 'btn-default',
              text: 'PDF',
              exportOptions: {
                columns: ':visible'
              }
            },
            {
              extend: 'print',
              className: 'btn-default',
              text: 'Imprimer',
              exportOptions: {
                columns: ':visible'
              }
            },

            {
              extend: 'colvis',
              className: 'btn-default',
              text: 'Visibilité',
              exportOptions: {
                columns: ':visible'
              }
            },
            {
                extend: 'spacer',
                style: '&nbsp;',
                text: '&nbsp;'
            },
          ],
            processing: true,
            serverSide: true,

              ajax: "{{ route('import.index') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'date', name: 'date'},
                  {data: 'num_connaissement', name: 'num_connaissement'},
                  {data: 'driver', name: 'driver'},
                  {data: 'vehicule', name: 'vehicule'},
                  {data: 'provenance', name: 'provenance' , visible:false},
                  {data: 'destination', name: 'destination'},
                  {data: 'client', name: 'client'},
                  {data: 'actions', name: 'actions', orderable: false, searchable: false , width:'10%'},
              ],
            orderCellsTop: true,
            order: [[ 0, 'desc' ]],
            pageLength: 50,
          });


    $('.data-table thead').on('input', '.search', function () {
    let strict = $(this).attr('strict') || false
    let value = strict && this.value ? "^" + this.value + "$" : this.value

    let index = $(this).parent().index()
    table.column(index).search(value, strict).draw()
        });
        });

        function deleteImport(id){
            swal.fire({
            title: "Supprimé?",
            icon: 'question',
            text: "Cette suppression engendrera la suppression de tous ce qui a relation avec ce dossier!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Oui, Supprimer!",
            cancelButtonText: "Non, annuler!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                //alert('hi');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = '{{ route("import.destroy", ":import") }}';
                url = url.replace(':import', id);
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
