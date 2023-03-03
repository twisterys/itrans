<div class="vertical-menu">
    <div class="h-100">
        <div class="user-wid text-center py-4">
            <div class="user-img">
                <img src="{{ asset('images/users/avatar-5.jpg') }}" alt="" class="avatar-md mx-auto rounded-circle">
            </div>
            <div class="mt-3">
                <a href="#" class="text-dark font-weight-medium font-size-16">{{ auth()->user()->name }}</a>
                <p class="text-body mt-1 mb-0 font-size-13">Administrateur</p>
            </div>
        </div>
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href={{ route('home') }} class="waves-effect">
                        <i class="mdi mdi-airplay"></i>
                        <span>Tableau de bord</span>
                    </a>
                </li>
                    @can('viewAny',App\Dossier::class)
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>Gestion des dossiers</span>
                            </a>
                            <ul class="sub-menu mm-show" aria-expanded="true">
                                <li><a href="{{route('import.index')}}">Import</a></li>
                                <li><a href="{{route('export.index')}}">Export</a></li>
                                <li><a href="{{route('national.index')}}">National</a></li>
                                {{-- <li><a href="{{route('dossier.index')}}">Tous</a></li> --}}
                            </ul>
                        </li>
                    @endcan
                    @can('viewAny',App\Vehicle::class)
                        <li>
                            <a href="{{route('vehicle.index')}}" class="waves-effect">
                                <i class="mdi mdi-car-multiple"></i>
                                <span>Gestion des véhicules</span>
                            </a>
                        </li>
                    @endcan
                    @can('viewAny',App\Person::class)
                        <li>
                            <a href="{{route('person.index')}}" class=" waves-effect">
                                <i class="mdi mdi-account-circle"></i>
                                <span>Gestion du personel</span>
                            </a>
                        </li>
                    @endcan
                        <li>
                            <a href="{{route('facture.index')}}" class=" waves-effect">
                                <i class="fas fa-file-invoice"></i>
                                <span>Gestion des factures</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('vente.index')}}" class=" waves-effect">
                                <i class="fab fa-sellcast"></i>
                                <span>Gestion des ventes</span>
                            </a>
                        </li>
                    @can('viewAny',App\Magasinage::class)
                        <li>
                            <a href="{{route('magasinage.index')}}" class=" waves-effect">
                                <i class="mdi mdi-stocking"></i>
                                <span>Gestion du magasinage</span>
                            </a>
                        </li>
                    @endcan  
                    
                    @can('viewAny',App\Gasoil::class)
                        <li>
                            <a href="{{route('gasoil.index')}}" class=" waves-effect">
                                <i class="mdi mdi-gradient"></i>
                                <span>Gestion du gasoil</span>
                            </a>
                        </li>
                    @endcan

                    @if (auth()->user()->is_admin || auth()->user()->hasPermissionTo('view_rapport'))
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span>Rapport</span>
                            </a>
                            <ul class="sub-menu mm-show" aria-expanded="true">
                                <li><a href="{{route('rapport.kilometrage')}}">Kilométrage</a></li>
                                {{-- <li><a href="{{route('dossier.index')}}">Tous</a></li> --}}
                            </ul>
                        </li>
                    @endif
                    
                    @can('viewAny',App\User::class)
                        <li>
                            <a href="{{route('user.index')}}" class=" waves-effect">
                                <i class="bx bxs-user"></i>
                                <span>Gestion Utilisateurs</span>
                            </a>
                        </li>
                    @endcan
                    @if (auth()->user()->is_admin)
                        <li>
                            <a href="{{route('client.index')}}" class=" waves-effect">
                                <i class="dripicons-user-group"></i>
                                <span>Gestion Clients</span>
                            </a>
                        </li>
                    @endif
                    @if (auth()->user()->is_admin)
                        <li>
                            <a href="{{route('plomos.index')}}" class=" waves-effect">
                                <i class="fab fa-bimobject"></i>
                                <span>Scelles douane</span>
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->is_admin)
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">
                                <i class="mdi mdi-settings"></i>
                                <span>Paramètres global</span>
                            </a>
                            
                            <ul class="sub-menu mm-show" aria-expanded="true">
                                <li><a href="{{route('TypeClient.index')}}">Types de Clients</a></li>
                                <li><a href="{{route('TypeFrais.index')}}">Types de Frais</a></li>
                                <li><a href="{{route('TypeVehicle.index')}}">Types de Véhicules</a></li>
                                <li><a href="{{route('station.index')}}">Stations</a></li>
                                <li><a href="{{route('depot.index')}}">Depots</a></li>
                                <li><a href="{{route('shema.index')}}">Schéma de facturation</a></li>
                                <li><a href="{{route('parametrage.expiration')}}">Expiration</a></li>
                            </ul>
                        </li>
                    @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
