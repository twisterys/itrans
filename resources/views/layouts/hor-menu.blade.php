<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo-sm-dark.png') }}" alt="" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo-light.png') }}" alt="" height="40">
                    </span>
                </a>

                <a href="index" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('images/logo-light.png') }}" alt="" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('images/logo-light.png') }}" alt="" height="40">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 d-lg-none header-item waves-effect waves-light" data-toggle="collapse" data-target="#topnav-menu-content">
                <i class="fa fa-fw fa-bars"></i>
            </button>

            <div class="topnav">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="{{route('home')}}" class="nav-link arrow-none" href="#" id="topnav-dashboard" role="button">
                                    Dashboard
                                </a>
                            </li>

                            @can('viewAny',App\Dossier::class)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dossiers <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                        <a href="{{ route('import.index') }}" class="dropdown-item">Import</a>
                                        <a href="{{ route('export.index') }}" class="dropdown-item">Export</a>
                                        <a href="{{ route('national.index') }}" class="dropdown-item">National</a>
                                    </div>
                                </li>
                            @endcan

                            @can('viewAny',App\Vehicle::class)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="{{ route('vehicle.index') }}" id="topnav-pages">
                                        Véhicules
                                    </a>
                                </li>
                            @endcan

                            @can('viewAny',App\Gasoil::class)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ressources <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                        <a href="{{ route('vehicle.index') }}" class="dropdown-item">Véhicules</a>
                                        <a href="{{ route('person.index') }}" class="dropdown-item">Chauffeurs</a>
                                        <a href="{{ route('plomos.index') }}" class="dropdown-item">Plomos</a>
                                        <a href="{{ route('gasoil.index') }}" class="dropdown-item">Gasoil</a>
                                    </div>
                                </li>
                            @endcan

                            @can('viewAny',App\Magasinage::class)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="{{ route('magasinage.index') }}" id="topnav-pages">
                                        Magasinage
                                    </a>
                                </li>
                            @endcan


                            @if (auth()->user()->is_admin)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Relation <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                        <a href="{{ route('client.index') }}" class="dropdown-item">Clients</a>
                                        <a href="{{ route('transitaire.index') }}" class="dropdown-item">Transitaire</a>

                                    </div>
                                </li>
                            @endif



                            @if (auth()->user()->is_admin || auth()->user()->hasPermissionTo('view_rapport'))
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Rapports <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                        <a href="{{route('rapport.index')}}" class="dropdown-item">Liste Tous Les Rapports</a>
                                        <a href="{{route('rapport.type',['id' => 'plomos'])}}" class="dropdown-item">Rapports Plomos</a>
                                        <a href="{{route('rapport.type',['id' => 'kilometrage_chauffeur'])}}" class="dropdown-item">Rapports Chauffeurs</a>
                                        <a href="{{route('rapport.type',['id' => 'kilometrage_vehicle'])}}" class="dropdown-item">Rapports Véhicules</a>
                                        <a href="{{route('rapport.kilometrage')}}" class="dropdown-item">Génerer Rapport</a>
                                    </div>
                                </li>
                            @endif



                            @if (auth()->user()->is_admin)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Paramètres  <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-pages">
                                        @can('viewAny',App\User::class)
                                                <a class="dropdown-item" href="{{ route('user.index') }}" id="topnav-pages">
                                                    Utilisateurs
                                                </a>
                                        @endcan
                                      <a  class="dropdown-item" href="{{route('TypeClient.index')}}">Types de Clients</a>
                                      <a  class="dropdown-item" href="{{route('generalFrais.index')}}">Global Frais</a>
                                      <a  class="dropdown-item" href="{{route('TypeFrais.index')}}">Types de Frais</a>
                                      <a  class="dropdown-item" href="{{route('TypeVehicle.index')}}">Types de Véhicules</a>
                                      <a  class="dropdown-item" href="{{route('TypePackaging.index')}}">Types de Emballages</a>
                                      <a  class="dropdown-item" href="{{route('station.index')}}">Stations</a>
                                      <a  class="dropdown-item" href="{{route('service.index')}}">Prestations</a>
                                      <a  class="dropdown-item" href="{{route('depot.index')}}">Depots</a>
                                      <a class="dropdown-item" href="{{ route('assuranceMarchandise.index') }}">Assurance Marchandise</a>
                                      <a class="dropdown-item" href="{{ route('assuranceTravail.index') }}">Assurance Travail</a>
                                      <a  class="dropdown-item" href="{{route('parametrage.expiration')}}">Expiration</a>

                                    </div>
                                </li>
                            @endif


                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="d-flex">
            <div class="dropdown d-inline-block d-lg-none ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ml-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="mdi mdi-fullscreen"></i>
                </button>
            </div>


            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-xl-inline-block ml-1">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    {{--<a class="dropdown-item" href="#"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profile</a>--}}
                    {{-- <a class="dropdown-item" href="#"><i class="bx bx-wallet font-size-16 align-middle mr-1"></i> My Wallet</a>
                    <a class="dropdown-item d-block" href="#"><span class="badge badge-success float-right">11</span><i class="bx bx-wrench font-size-16 align-middle mr-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="bx bx-lock-open font-size-16 align-middle mr-1"></i> Lock screen</a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i>Déconnexion</a>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>


        </div>
    </div>
</header>
