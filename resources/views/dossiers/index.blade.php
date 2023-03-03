@extends('layouts.master-layouts')

@section('title') Dossiers @endsection
@section('css')
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>
@endsection

@section('content')
    @component('common-components.breadcrumb')
         @slot('title') Dossiers  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent
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
                                                <th>EORI N°</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                                <th>&nbsp;</th>
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
              ajax: "{{ route('dossier.index') }}",
              columns: [
                  {data: 'id', name: 'id'},
                  {data: 'num_EORI', name: 'num_EORI'},
                  {data: 'date', name: 'date'},
                  {data: 'type', name: 'type'},
                  {data: 'actions', name: 'actions', orderable: false, searchable: false},
              ]
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