@extends('layouts.master-layouts')

@section('title') Schémas @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>

@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Schémas  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent

                    <div style="margin-bottom: 10px;" class="row">
                        <div class="col-md-12">
                            <a href="{{route('shema.create')}}" class="btn btn-success float-right">Ajouter (+)</a>
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
                                                <th>Nom</th>
                                                <th>Type</th>
                                                <th>Date</th>
                                                <th>Commencé de</th>
                                                <th>Préfixe</th>
                                                <th>Suffixe</th>
                                                <th>Nombre de chiffre</th>
                                                <th>Nombre de facture</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td>
                                                    <select class="search">
                                                        <option value>Tous</option>
                                                        @foreach (App\Shema::TYPE_SELECT as $key => $label)
                                                            <option value="{{$label}}">{{$label}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
                                                <td><input class="search" type="text" placeholder="Rechercher" style="width: 100px;font-size: 10px;"></td>
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
              processing: true,
              serverSide: true,
              ajax: "{{ route('shema.index') }}",
              columns: [

                  {data: 'id', name: 'id'},
                  {data: 'nom', name: 'nom'},
                  {data: 'type', name:'type'},
                  {data: 'date', name: 'date'},
                  {data: 'start_from', name: 'start_from'},
                  {data: 'prefix', name: 'prefix'},
                  {data: 'suffix', name: 'suffix'},
                  {data: 'letterscount', name: 'letterscount'},
                  {data: 'current', name: 'current'},
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


        function deleteShema(id){
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
                var url = '{{ route("shema.destroy", ":shema") }}';
                url = url.replace(':shema', id);
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
