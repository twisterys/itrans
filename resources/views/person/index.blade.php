@extends('layouts.master-layouts')

@section('title') Chauffeurs @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>

@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Chauffeurs  @endslot
         @slot('action')  <a class="btn btn-success " href="{{route('person.create')}}">Nouveau chauffeur </a>    @endslot
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
                                                <th>Matricule</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Fonction</th>
                                                <th>Section</th>
                                                <th>Date Naissance</th>
                                                <th>CIN</th>
                                                <th>Télé</th>
                                                <th>Type</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 80px;font-size: 10px;"></td>
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

    @endsection

@section('script')


    <script type="text/javascript">
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
              ajax: "{{ route('person.index') }}",
              columns: [
                  {data: 'matricule', name: 'matricule'},
                  {data: 'nom', name: 'nom'},
                  {data: 'prenom', name: 'prenom'},
                  {data: 'fonction', name: 'fonction'},
                  {data: 'section', name: 'section'},
                  {data: 'date_naiss', name: 'date_naiss'},
                  {data: 'cin', name: 'cin'},
                  {data: 'tele', name: 'tele'},
                  {data: 'type', name: 'type'},
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


        function deletePerson(id){
            swal.fire({
            title: "Supprimé?",
            icon: 'question',
            text: "Cette suppression engendrera la suppression de tous ce qui a relation avec ce personne!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Oui, Supprimer!",
            cancelButtonText: "Non, annuler!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                //alert('hi');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = '{{ route("person.destroy", ":person") }}';
                url = url.replace(':person', id);
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



<!-- Required datatable js -->
{{-- <script src="{{ asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('/libs/pdfmake/pdfmake.min.js')}}"></script> --}}

<!-- Datatable init js -->
{{-- <script src="{{ asset('/js/pages/datatables.init.js')}}"></script> --}}

@endsection
