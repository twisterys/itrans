@extends('layouts.master-layouts')

@section('title') Gasoil @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>

@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Gasoil  @endslot
         @slot('action')  <a class="btn btn-success " href="{{route('gasoil.create')}}">Nouveau gasoil </a>    @endslot
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
                                                <th>Date</th>
                                                <th>Station</th>
                                                <th>Kilométrage</th>
                                                <th>Chauffeur</th>
                                                <th>Véhicules</th>
                                                <th>Prix</th>
                                                <th>Quantité</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <th><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></th>
                                                <th><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></th>
                                                <th><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></th>
                                                <th><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></th>
                                                <th><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></th>
                                                <th><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></th>
                                                <th><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></th>
                                                <th></th>
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
              processing: true,
              serverSide: true,
              ajax: "{{ route('gasoil.index') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'date', name: 'date'},
                  {data: 'station', name: 'station'},
                  {data: 'kilometrage', name: 'kilometrage'},
                  {data: 'chauffeur', name: 'chauffeur'},
                  {data: 'matricule', name: 'matricule'},
                  {data: 'prix', name: 'prix'},
                  {data: 'qte', name: 'qte'},

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

        function deleteGasoil(id){
            swal.fire({
            title: "Supprimé?",
            icon: 'question',
            text: "Voulez vous vraiment supprimer!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Oui, Supprimer!",
            cancelButtonText: "Non, annuler!",
            reverseButtons: !0
        }).then(function (e) {
            if (e.value === true) {
                //alert('hi');
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                var url = '{{ route("gasoil.destroy", ":gasoil") }}';
                url = url.replace(':gasoil', id);
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
