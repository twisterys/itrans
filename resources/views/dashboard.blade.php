@extends('layouts.master-layouts')

@section('title') Dashboard @endsection

@section('content')
    @component('common-components.breadcrumb')
         @slot('title') Dashboard   @endslot
         @slot('title_li') Dashboard   @endslot
     @endcomponent

<div class="row">
    <div class="col-xl-6">
        <div class="row">
            @if (auth()->user()->is_admin )
            <div class="col-6">
                <div class="card bg-info">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-white font-weight-medium mt-1 mb-2">Vehicules</p>
                                    <h4 class="text-white">{{ $nbVehicles }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-danger">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-white font-weight-medium mt-1 mb-2">Imports</p>
                                    <h4 class="text-white">{{ $nbImports }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-success">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-white font-weight-medium mt-1 mb-2">Exports</p>
                                    <h4 class="text-white">{{ $nbExports }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card bg-warning">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-white font-weight-medium mt-1 mb-2">Nationals</p>
                                    <h4 class="text-white">{{ $nbNational }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(auth()->user()->hasPermissionTo('view_magasinage') || auth()->user()->is_admin)
            <div class="col-6">
                <div class="card bg-secondary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <p class="text-white font-weight-medium mt-1 mb-2">Magasinages</p>
                                    <h4 class="text-white">{{ $nbMagasin }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif()
        </div>

    </div>
    @if (auth()->user()->is_admin )
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title mb-4">Expiré prochainement</h4>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Véhicule</th>
                                <th>Matricule</th>
                                <th>Genre</th>
                                <th>Expire dans</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($alerts as $item)
                                @if ($item)
                                    @if($item['rest_days'] <=3)
                                    <tr class="alert alert-danger">
                                        <td>{{$item['genre']}}</td>
                                        <td>{{$item['matricule_vehicle']}}</td>
                                        <td>{{$item['type_alert']}}</td>
                                        <td>{{$item['rest_days']}} jours</td>
                                    </tr>

                                    @else
                                    <tr>
                                        <td>{{$item['genre']}}</td>
                                        <td>{{$item['matricule_vehicle']}}</td>
                                        <td>{{$item['type_alert']}}</td>
                                        <td>{{$item['rest_days']}} jours</td>
                                    </tr>
                                    @endif
                                @endif
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($restPlomos > $expiration->plomos_expiration)
                    <div class="alert alert-success mt-3" role="alert">
                        Il reste <a href="" class="alert-link">{{$restPlomos}} des Scelles douane</a>
                    </div>
                @else
                    <div class="alert alert-danger mt-3" role="alert">
                        Il reste <a href="" class="alert-link">{{$restPlomos}} des Scelles douane</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @endif


    </div>

</div>
<!-- end row -->

@endsection

@section('script')
@endsection
