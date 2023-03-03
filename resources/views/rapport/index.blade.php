@extends('layouts.master-layouts')

@section('title') Rapport @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>

@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Rapport  @endslot
         @slot('action')  <a class="btn btn-success " href="{{route('rapport.kilometrage')}}">Génerer Rapport </a>    @endslot
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
                                                <th>#</th>
                                                <th>Type</th>
                                                <th>Premiére Date</th>
                                                <th>Deuxieme Date</th>
                                                <th>Date de création</th>
                                                <th>Status</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <select class="search">
                                                        <option value="">Tous</option>
                                                        @foreach (App\Rapport::TYPE_RAPPORT as $key => $label)
                                                            <option value="{{$label}}">{{$label}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
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
              processing: true,
              serverSide: true,
              ajax: "{{ route('rapport.index') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'type', name: 'type'},
                  {data: 'premiere_date', name: 'premiere_date'},
                  {data: 'deuxieme_date', name: 'deuxieme_date'},
                  {data: 'date_creation', name: 'date_creation'},
                  {data: 'status', name: 'status'},
                  {data: 'actions', name: 'actions', orderable: false, searchable: false},
              ],
              orderCellsTop: true,
            order: [[ 0, 'desc' ]],
            pageLength: 10
          });
          $('.data-table thead').on('input', '.search', function () {
    let strict = $(this).attr('strict') || false
    let value = strict && this.value ? "^" + this.value + "$" : this.value

    let index = $(this).parent().index()
    table.column(index).search(value, strict).draw()

        });

        });

      </script>



<!-- Required datatable js -->
{{-- <script src="{{ asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('/libs/pdfmake/pdfmake.min.js')}}"></script> --}}

<!-- Datatable init js -->
{{-- <script src="{{ asset('/js/pages/datatables.init.js')}}"></script> --}}

@endsection
