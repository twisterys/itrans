@extends('layouts.master-layouts')

@section('title') Vehicules @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Afficher Vehicule  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


     <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-white">
                    <a class="btn btn-secondary pull-right" href="{{route('vehicle.index')}}">
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
                                            Matricule
                                        </th>
                                        <td>
                                            {{$vehicle->N_immatriculation}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Marque
                                        </th>
                                        <td>
                                            {{$vehicle->marque}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Model
                                        </th>
                                        <td>
                                            {{$vehicle->modele}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Proprietaire
                                        </th>
                                        <td>
                                            {{$vehicle->proprietaire}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Date de validité
                                        </th>
                                        <td>
                                            {{$vehicle->date_debut_validite}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Type Vehicule
                                        </th>
                                        <td>
                                            {{$vehicle->genre}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            date_pre_mise_circul
                                        </th>
                                        <td>
                                            {{$vehicle->date_pre_mise_circul}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            M.C. au Maroc
                                        </th>
                                        <td>
                                            {{$vehicle->date_m_c_maroc}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Mutation le
                                        </th>
                                        <td>
                                            {{$vehicle->date_mutation}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Carburant
                                        </th>
                                        <td>
                                            {{$vehicle->type_carburant}}
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
                                            Proprietaire
                                        </th>
                                        <td>
                                            {{$vehicle->proprietaire}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Puissance fiscale
                                        </th>
                                        <td>
                                            {{$vehicle->puissance_fiscale}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Nbre cylindres
                                        </th>
                                        <td>
                                            {{$vehicle->nbr_cylindre}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            N° du chassis
                                        </th>
                                        <td>
                                            {{$vehicle->num_chassis}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            nbr_cylindre
                                        </th>
                                        <td>
                                            {{$vehicle->nbr_cylindre}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            P.T.A.C
                                        </th>
                                        <td>
                                            {{$vehicle->P_T_A_C}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            P.T.M.C.T
                                        </th>
                                        <td>
                                            {{$vehicle->P_T_M_C_T}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>
                                            Poids à Vide
                                        </th>
                                        <td>
                                            {{$vehicle->poids_a_vide}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Fichier
                                        </th>
                                        <td>
                                            <ul>
                                                @forelse ($vehicle->vehicle_file as $key => $media)
                                                
                                                    @if (File::exists($media->getPath()))
                                                    
                                                        <li>
                                                         
                                                            <a href="{{ $media->getUrl() }}" target="_blank"><img src="https://i.ibb.co/m6m7hXh/pdf.png" width="30px">
                                                            {{ $media->name ?? ''  }}
                                                            </a>
                                                            <button type="button" class="btn btn- btn-sm btn-danger  delete-form float-right" data-toggle="tooltip" title="Supprimer" onclick="deleteDoc({{$media->id}})"><i class="fa fa-trash"></i></button>
                                                        </li>
                                                    @else
                                                        
                                                    @endif
                                                @empty
                                            </ul>
                                                    Y'a pas de fichier
                                                @endforelse
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="card border border-info">
                                <div class="card-header bg-info">
                                    <h5 class="">
                                        Assurance
                                        <a style="font-size: 140%;" class="float-right" data-toggle="tooltip" title="Ajouter Assurance" target="_Blank" href="{{route('vehicle.assurance.create',$vehicle->id)}}"><i class="bx bxs-comment-add"></i></a>
                                        <a style="font-size: 140%;" class="float-right mr-1" target="_Blank" data-toggle="tooltip" title="Afficher les Assurances"  href="{{route('vehicle.assurance.index',$vehicle->id)}}"><i class="bx bx-history"></i></a>

                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            @forelse ($vehicle->assurances as $item)
                                                <tr>
                                                    <th>
                                                        Date Expiration
                                                    </th>
                                                    <td>
                                                        {{$item->expiration}}
                                                    </td>
                                                </tr>
                                            @empty
                                                <h4 class="text-center">Absence d'assurance! <a href="{{route('vehicle.assurance.create',$vehicle->id)}}">Créez?</a></h4>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                        <div class="col-4">
                            <div class="card border border-info">
                                <div class="card-header bg-info">
                                    <h5 class="">
                                        Visite Technique
                                        <a style="font-size: 140%;" class="float-right " target="_Blank" data-toggle="tooltip" title="Ajouter Visite Technique" href="{{route('vehicle.technicalVisit.create',$vehicle->id)}}"><i class="bx bxs-comment-add"></i></a>
                                         <a style="font-size: 140%;" class="float-right mr-1" target="_Blank" data-toggle="tooltip" title="Afficher les visite technique" href="{{route('vehicle.technicalVisit.index',$vehicle->id)}}"><i class="bx bx-history"></i></a>
                                        </h5>

                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            @forelse ($vehicle->technicalVisits as $item)
                                            <tr>
                                                <th>
                                                    Date Expiration
                                                </th>
                                                <td>
                                                    {{$item->date_next_visit}}
                                                </td>
                                            </tr>
                                            @empty
                                            <h4 class="text-center">Absence de visite Technique! <a href="{{route('vehicle.technicalVisit.create',$vehicle->id)}}">Créez?</a></h4>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                        <div class="col-4">
                            <div class="card border border-info">
                                <div class="card-header bg-info">
                                    <h5 class="">
                                        Disque
                                        <a style="font-size: 140%;" class="float-right " target="_Blank" data-toggle="tooltip" title="Ajouter Disque" href="{{route('vehicle.taco.create',$vehicle->id)}}"><i class="bx bxs-comment-add"></i></a>
                                        <a style="font-size: 140%;" class="float-right mr-1" target="_Blank" data-toggle="tooltip" title="Afficher les disques"  href="{{route('vehicle.taco.index',$vehicle->id)}}"><i class="bx bx-history"></i></a>
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            @forelse ($vehicle->tacos as $item)
                                            <tr>
                                                <th>
                                                    Date Expiration
                                                </th>
                                                <td>
                                                    {{$item->date_expiration}}
                                                </td>
                                            </tr>
                                            @empty
                                            <h4 class="text-center">Absence de disk! <a href="{{route('vehicle.taco.create',$vehicle->id)}}">Créez?</a></h4>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                        <div class="col-4">
                            <div class="card border border-info">
                                <div class="card-header bg-info">
                                    <h5 class="">
                                        Extincteur
                                        <a style="font-size: 140%;" class="float-right " target="_Blank" data-toggle="tooltip" title="Ajouter Extincteur" href="{{route('vehicle.exctinteur.create',$vehicle->id)}}"><i class="bx bxs-comment-add"></i></a>
                                        <a style="font-size: 140%;" class="float-right mr-1" target="_Blank" data-toggle="tooltip" title="Afficher les Extincteurs" href="{{route('vehicle.exctinteur.index',$vehicle->id)}}"><i class="bx bx-history"></i></a>
                                    </h5>
                                </div>

                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            @forelse ($vehicle->extinteurs as $item)
                                            <tr>
                                                <th>
                                                    Date Expiration
                                                </th>
                                                <td>
                                                    {{$item->date_next_control}}
                                                </td>
                                            </tr>
                                            @empty
                                            <h4 class="text-center">Absence de Extinteur! <a href="{{route('vehicle.exctinteur.create',$vehicle->id)}}">Créez?</a></h4>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                        @if($vehicle->tacos != '[]')
                        <div class="col-4">
                            <div class="card border border-info">
                                <div class="card-header bg-info">
                                    @forelse ($vehicle->tacos as $item)
                                    <h5 class="">
                                        Visite Technique de Disque
                                        <a style="font-size: 140%;" class="float-right" data-toggle="tooltip" title="Ajouter Visite technique de disque" target="_Blank" href="{{route('taco.visiteTechnique.create',$item->id)}}"><i class="bx bxs-comment-add"></i></a>
                                        <a style="font-size: 140%;" class="float-right mr-1" target="_Blank" data-toggle="tooltip" title="Afficher les visites technique de disque" href="{{route('taco.visiteTechnique.index',$item->id)}}"><i class="bx bx-history"></i></a>
                                    </h5>
                                    @empty
                                    @endforelse
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            @forelse ($vehicle->tacos as $item)
                                                @forelse ($item->visitTechnique as $i)
                                                    <tr>
                                                        <th>
                                                            Date Expiration
                                                        </th>
                                                        <td>
                                                            {{$i->date_next_visit}}
                                                        </td>
                                                    </tr>
                                                @empty
                                                <h4 class="text-center">Absence de Visite technique te Disk! <a href="{{route('taco.visiteTechnique.create',$item->id)}}">Créez?</a></h4>
                                                @endforelse
                                            @empty
                                            <h4 class="text-center">Absence de Visite technique te Disk!</h4>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                        </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

    @endsection

@section('script')

    <script>
        function deleteDoc(id){

    swal.fire({
    title: "Supprimé?",
    icon: 'question',
    text: "Voulez vous vraiment supprimer ce document!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonText: "Oui, Supprimer!",
    cancelButtonText: "Non, annuler!",
    reverseButtons: !0
}).then(function (e) {
    if (e.value === true) {
        //alert('hi');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url = '{{ route("doc.delete", ":doc") }}';
        url = url.replace(':doc', id);
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

@endsection
