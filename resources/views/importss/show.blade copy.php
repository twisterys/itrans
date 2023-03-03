@extends('layouts.master-layouts')

@section('title') Imports @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Afficher Import  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


     <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title"></h4>
                    <p class="card-title-desc"></p>
                     <!-- Nav tabs -->
                     <ul class="nav nav-pills nav-justified" role="tablist">
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link active" data-toggle="tab" href="#import" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Import</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#personalExpense" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Frais Personel</span>
                            </a>
                        </li>
                        <li class="nav-item waves-effect waves-light">
                            <a class="nav-link" data-toggle="tab" href="#detail_import" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Détail Import</span>
                            </a>
                        </li>
                    </ul>



                                        <!-- Tab panes -->
                      <div class="tab-content p-3 text-muted">
                          <div class="tab-pane active" id="import" role="tabpanel">
                              <p class="mb-0">

                                <div class="row">
                                    <div class="col-6">

                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        N° Dossier
                                                    </th>
                                                    <td>
                                                        {{$import->id}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        EORI N°
                                                    </th>
                                                    <td>
                                                        {{$import->num_EORI}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Driver
                                                    </th>
                                                    <td>
                                                        {{$import->driver}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Mat. Camion
                                                    </th>
                                                    <td>
                                                        {{$import->mat_camion}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Mat. Remorque
                                                    </th>
                                                    <td>
                                                        {{$import->mat_remorque}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Mat. Contenaire
                                                    </th>
                                                    <td>
                                                        {{$import->mat_contenaire}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Compagnie
                                                    </th>
                                                    <td>
                                                       {{$import->compagnie}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Navire
                                                    </th>
                                                    <td>
                                                        {{$import->navire}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        provenance
                                                    </th>
                                                    <td>
                                                        {{$import->provenance}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Destination
                                                    </th>
                                                    <td>
                                                        {{$import->destination}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Date Arrivée
                                                    </th>
                                                    <td>
                                                        {{$import->date_arrive}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Observation
                                                    </th>
                                                    <td>
                                                        {{$import->observation}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                                            <div class="col-6">

                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Manifeste
                                                    </th>
                                                    <td>
                                                        {{$import->manifeste}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Connaissement N°
                                                    </th>
                                                    <td>
                                                        {{$import->num_connaissement}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Tarre
                                                    </th>
                                                    <td>
                                                       {{$import->tarre}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Poid Brut
                                                    </th>
                                                    <td>
                                                       {{$import->poid_brut}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Nbre Colis
                                                    </th>
                                                    <td>
                                                       {{$import->nbr_colis}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Frais péage
                                                    </th>
                                                    <td>
                                                       {{$import->frais_peage}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Frais TMSA
                                                    </th>
                                                    <td>
                                                       {{$import->frais_TMSA}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        montant_fret
                                                    </th>
                                                    <td>
                                                       {{$import->montant_fret}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Devise
                                                    </th>
                                                    <td>
                                                       {{$import->devise}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Cours
                                                    </th>
                                                    <td>
                                                       {{$import->cours}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Date Sortie
                                                    </th>
                                                    <td>
                                                       {{$import->date_sortie}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Type
                                                    </th>
                                                    <td>
                                                       {{$import->type}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                              </p>
                          </div>
                          <v class="tab-pane" id="personalExpense" role="tabpanel">
                              <p class="mb-0">
                                <div class="row">
                                    <div class="col-6">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Frais Auto
                                                    </th>
                                                    <td>
                                                       {{$import->personalExpense->frais_auto}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Frais Gasoil
                                                    </th>
                                                    <td>
                                                        {{$import->personalExpense->frais_gasoil}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Déplacement
                                                    </th>
                                                    <td>
                                                        {{$import->personalExpense->deplacement}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-6">
                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Frais Tél
                                                    </th>
                                                    <td>
                                                        {{$import->personalExpense->frais_tele}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Nbre Jours
                                                    </th>
                                                    <td>
                                                       {{$import->personalExpense->nbre_days}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Frais Total
                                                    </th>
                                                    <td>
                                                       {{$import->personalExpense->frais_total}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                              </p>
                          </v>


                          <div class="tab-pane" id="detail_import" role="tabpanel">
                              <p class="mb-0">
                                <table id="datatable-buttons" class="table table-bordered data-table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Client</th>
                                            <th>Importateur</th>
                                            <th>Exportateur</th>
                                            <th>Transitaire</th>
                                            <th>Marchandise</th>
                                            <th>D.U.M</th>
                                            <th>Nbr Colis</th>
                                            <th>Poid Brute</th>
                                            <th>Observation</th>
                                        </tr>
                                    </thead>

                                </table>
                              </p>
                          </div>

         </div>
            </div>
        </div>
    </div>

    @endsection

    @section('script')


    <script type="text/javascript">
        $(function () {

          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('import.show',$import->id) }}",
              columns: [
                  {data: 'type', name: 'type'},
                  {data: 'client', name: 'client'},
                  {data: 'importateur', name: 'importateur'},
                  {data: 'exportateur', name: 'exportateur'},
                  {data: 'transitaire', name: 'transitaire'},
                  {data: 'marchandise', name: 'marchandise'},
                  {data: 'dum', name: 'dum'},
                  {data: 'numb_colis', name: 'numb_colis'},
                  {data: 'poid_brute', name: 'poid_brute'},
                  {data: 'observ', name: 'observ'},
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
