@extends('layouts.master-layouts')

@section('title') Profile @endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Profile  @endslot
         @slot('li_1') Pages  @endslot
     @endcomponent


                    <!-- start row -->
                    <div class="row">
                        <div class="col-md-12 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="profile-widgets py-3">

                                        <div class="text-center">
                                            <div class="">
                                                @forelse ($person->person_file as $key => $media)
                                                <img src="{{ $media->getUrl() }}" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                                       
                                                @empty
                                                    <img src="/images/users/avatar-2.jpg" alt="" class="avatar-lg mx-auto img-thumbnail rounded-circle">
                                                    <div class="online-circle"><i class="fas fa-circle text-success"></i></div>
                                                @endforelse
                                                
                                            </div>

                                            <div class="mt-3 ">
                                                <a href="#" class="text-dark font-weight-medium font-size-16">{{$person->nom}} {{$person->prenom}}</a>
                                                <p class="text-body mt-1 mb-1">{{App\Person::FONCTION[$person->fonction]}}</p>

                                                {{-- <span class="badge badge-success">Follow Me</span>
                                                <span class="badge badge-danger">Message</span> --}}
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Personal Information</h5>

                                    {{-- <p class="card-title-desc">
                                        Hi I'm Patrick Becker, been industry's standard dummy ultrices Cambridge.
                                    </p> --}}

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Date Naissance</p>
                                        <h6 class="">{{$person->date_naiss}}</h6>
                                    </div>

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Télephone</p>
                                        <h6 class="">{{$person->tele}}</h6>
                                    </div>

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Address</p>
                                        <h6 class="">{{$person->adress}}</h6>
                                    </div>

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Nationnalité</p>
                                        <h6 class="">{{$person->nationalite ? App\Person::NATIONALITE[$person->nationalite] : ''}}</h6>
                                    </div>

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Situation Familiale</p>
                                        <h6 class="">{{$person->situation_familiale ? App\Person::SITUATION_FAMILIALE[$person->situation_familiale] : ''}}</h6>
                                    </div>
                                    @if ($person->situation_familiale != 'celibataire')
                                        <div class="mt-3">
                                            <p class="font-size-12 text-muted mb-1">Nombre Enfants</p>
                                            <h6 class="">{{$person->nbre_enfant}}</h6>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-2">Status</h5>
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Section</p>
                                        <h6 class="">{{$person->section ? App\Person::SECTION[$person->section] : ''}}</h6>
                                    </div>

                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Date Embauche</p>
                                        <h6 class="">{{$person->date_embauche}}</h6>
                                    </div>
                                    <div class="mt-3">
                                        <p class="font-size-12 text-muted mb-1">Date Départ</p>
                                        <h6 class="">{{$person->date_depart}}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12 col-xl-9">
                            <div class="row">

                                <div class="col-md-12 col-xl-4">
                                    <div class="card bg-danger">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <p class="mb-2 text-white">Nombre Imports</p>
                                                    <h4 class="mb-0">{{$nbImport}}</h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-4">
                                    <div class="card bg-success">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <p class="mb-2 text-white">Nombre Exports</p>
                                                    <h4 class="mb-0">{{$nbExport}}</h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xl-4">
                                    <div class="card bg-warning">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-8">
                                                    <p class="mb-2 text-white">Nombre Nationals</p>
                                                    <h4 class="mb-0">{{$nbNational}}</h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>



                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Elements Salaire</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            <table class="table table-bordered table-striped">
                                                <tbody>
                                                    @if ($person->categorie == 'mensuele')
                                                    <tr class="col-4">
                                                        <th>
                                                            Salaire de Base

                                                        </th>
                                                        <td>
                                                            {{$person->salaire_base}}
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr class="col-4">
                                                        <th>
                                                            Taux Horaire
                                                        </th>
                                                        <td>
                                                            {{$person->taux_horaire}}
                                                        </td>
                                                    </tr>
                                                @endif
                                                    <tr class="col-4">
                                                        <th>
                                                            N° Camp Banc
                                                        </th>
                                                        <td>
                                                            {{$person->date_affiliation}}
                                                        </td>
                                                    </tr>
                                                    <tr class="col-4">
                                                        <th>
                                                            Prime présentation
                                                        </th>
                                                        <td>
                                                            {{$person->date_affiliation}}
                                                        </td>
                                                    </tr>
                                                    <tr class="col-4">
                                                        <th>
                                                            Prime de Logement
                                                        </th>
                                                        <td>
                                                            {{$person->date_affiliation}}
                                                        </td>
                                                    </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-6">
                                            <table class="table table-bordered table-striped">
                                            <tbody></tbody>
                                                <tr class="col-4">
                                                    <th>
                                                        Banque

                                                    </th>
                                                    <td>
                                                        {{$person->banque}}
                                                    </td>
                                                </tr>
                                                <tr class="col-4">
                                                    <th>
                                                        Mode Réglement
                                                    </th>
                                                    <td>
                                                        {{$person->mode_reglement}}
                                                    </td>
                                                </tr>
                                                <tr class="col-4">
                                                    <th>
                                                        Prime de panier
                                                    </th>
                                                    <td>
                                                        {{$person->prime_panier}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Organismes sociaux</h4>
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr class="col-4">
                                                <th>
                                                    Date Affiliation

                                                </th>
                                                <td>
                                                    {{$person->retraite}}
                                                </td>
                                            </tr>
                                            <tr class="col-4">
                                                <th>
                                                    CNSS
                                                </th>
                                                <td>
                                                    {{$person->cnss}}
                                                </td>
                                            </tr>
                                            <tr class="col-4">
                                                <th>
                                                    Date Affiliation
                                                </th>
                                                <td>
                                                    {{$person->date_affiliation}}
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>


             </div>

            <!-- end row -->
    @endsection

    @section('script')
    <!-- apexcharts -->

    @endsection
