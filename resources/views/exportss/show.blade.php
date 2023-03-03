@extends('layouts.master-layouts')

@section('title') Export @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Afficher Export  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


     <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-white">
                    <a class="btn btn-secondary pull-right" href="{{route('export.index')}}">
                        Retour à la liste
                    </a>
                    <hr>
                </div>
                <div class="card-body">



                                <div class="row">
                                    <div class="col-6">

                                        <table class="table table-bordered table-striped">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        N° Dossier
                                                    </th>
                                                    <td>
                                                        {{$export->id ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Véhicules</th>
                                                    <td>@foreach($export->dossierVehicles as $key => $vehicule)
                                                        <span class="badge bg-primary text-white">
                                                            {{$vehicule->vehicle_id ? $vehicule->vehicles->N_immatriculation : ($vehicule->matricule ? $vehicule->matricule : "Vous n'avez pas ajouter de véhicules dans ce dossier")}}
                                                         </span>
                                                    @endforeach</td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Chauffeur
                                                    </th>
                                                    <td>
                                                        @foreach ($export->chauffeur as $item)
                                                            <span class="badge bg-primary text-white">
                                                                {{$item->nom.' '.$item->prenom}}
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Compagnie
                                                    </th>
                                                    <td>
                                                       {{$export->compagnie ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Navire
                                                    </th>
                                                    <td>
                                                        {{$export->navire ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        provenance
                                                    </th>
                                                    <td>
                                                        {{$export->provenance ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Destination
                                                    </th>
                                                    <td>
                                                        {{$export->destination ?? ''}}
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
                                                        Date Arrivée
                                                    </th>
                                                    <td>
                                                        {{$export->date_arrive ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Date Sortie
                                                    </th>
                                                    <td>
                                                       {{$export->date_sortie ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Tarre
                                                    </th>
                                                    <td>
                                                       {{$export->tarre ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Poid Brut
                                                    </th>
                                                    <td>
                                                       {{$export->poid_brut ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Nbre Colis
                                                    </th>
                                                    <td>
                                                       {{$export->nbr_colis ?? ''}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Observation
                                                    </th>
                                                    <td>
                                                        {{$export->observation ?? ''}}
                                                    </td>
                                                </tr>




                                                <tr>
                                                    <th>
                                                        Type de chargement
                                                    </th>
                                                    <td>
                                                       {{App\Dossier::TYPE_CHARGEMENT[$export->type_chargement] ?? ''}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <h4>Véhicules</h4>
                                        <table class=" table table-bordered table-striped table-hover">
                                            <thead class="text-white bg-dark">
                                            <tr>
                                                <th> Type de véhicule </th>
                                                <th> Matricule </th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($export->dossierVehicles as $key => $vehicule)
                                        <tr>
                                            <td>{{App\Vehicle::TYPE_VEHICLE[$vehicule->type] ?? ''}}</td>
                                            <td>{{$vehicule->matricule ?? ''}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>

                                    </div> --}}

                                    <div class="col-md-12">
                                        <h4>Items</h4>
                                        <table class=" table table-bordered table-striped table-hover">
                                            <thead class="text-white bg-dark">
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
                                    <tbody>
                                        @foreach($export->dossierItems as $key => $item)
                                        <tr>
                                            <td>{{$item->client->nom ?? ''}}</td>
                                            <td>{{$item->importateur ?? ''}}</td>
                                            <td>{{$item->exportateur ?? ''}}</td>
                                            <td>{{$item->transitaire->nom ?? ''}}</td>
                                            <td>{{$item->marchandise ?? ''}}</td>
                                            <td>{{$item->dum ?? ''}}</td>
                                            <td>{{$item->numb_colis ?? ''}}</td>
                                            <td>{{$item->poid_brute ?? ''}}</td>
                                            <td>{{$item->observ ?? ''}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>

                                    </div>
                                    <div class="col-md-6">
                                        <h4>Véhicules</h4>
                                        <table class=" table table-bordered table-striped table-hover">
                                            <thead class="text-white bg-dark">
                                            <tr>
                                                <th class="text-center">Matricule</th>
                                                <th class="text-center">Plomos</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        <tr>
                                            <td>

                                                @forelse ($export->dossierVehicles as $v)
                                                <span class="badge bg-info"><h5 class="text-white">{{ $v->vehicles ? $v->vehicles->N_immatriculation : $v->matricule }}</h5></span>
                                                @empty

                                                @endforelse
                                            </td>
                                            <td>
                                                @forelse ($export->plomos as $plomos)
                                                    <span class="badge bg-info"><h5 class="text-white">{{ $plomos->num_serie }}</h5></span>
                                                @empty

                                                @endforelse
                                            </td>
                                        </tr>

                                    </tbody>
                                    </table>

                                    </div>
                                    <div class="col-md-6">
                                        <h4>Frais</h4>
                                        <table class=" table table-bordered table-striped table-hover">
                                            <thead class="text-white bg-dark">
                                            <tr>
                                                <th class="text-center">Type de frais</th>
                                                <th class="text-center">Montant</th>

                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach($export->personalExpenses as $key => $expense)
                                        <tr>
                                            <td>{{ $expense->TypeFrais ? $expense->TypeFrais->name : '' }}</td>
                                            <td>{{$expense->montant ?? ''}} {{  App\PersonalExpense::DEVISE[$expense->devise] ?? '' }} </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    </table>

                                    </div>

                                    </div>
                                </div>

         </div>
            </div>
        </div>


    @endsection

    @section('script')

      </script>



<!-- Required datatable js -->
{{-- <script src="{{ asset('/libs/datatables/datatables.min.js')}}"></script>
<script src="{{ asset('/libs/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('/libs/pdfmake/pdfmake.min.js')}}"></script> --}}

<!-- Datatable init js -->
{{-- <script src="{{ asset('/js/pages/datatables.init.js')}}"></script> --}}

@endsection
