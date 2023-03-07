<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico')}}">
    <link href="{{ asset('libs/jquery-ui/toastr.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css')}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.min.css')}}" id="app-light" rel="stylesheet" type="text/css" />
</head>

<body data-layout="horizontal" data-topbar="dark">


        <div class="main-content">
            <div class="page-content">
    <div class="col-lg-12">
        <div class="card">

            <div class="card-body">


                <div class="row">
                    <div class="col-12">

                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <th>
                                    Client
                                </th>
                                <td>
                                    {{$magasinage->client->nom ?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Date Entrée
                                </th>
                                <td>
                                    {{$magasinage->date_entree?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Date Sortie
                                </th>
                                <td>
                                    {{$magasinage->date_sortie?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Matricule Entrée
                                </th>
                                <td>
                                    {{$magasinage->mat_entree?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Matricule Sortie
                                </th>
                                <td>
                                    {{$magasinage->mat_sortie?? ''}}
                                </td>
                            </tr> <tr>
                                <th>
                                    Depot
                                </th>
                                <td>
                                    {{$magasinage->depot->nom?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Poids Brute
                                </th>
                                <td>
                                    {{$magasinage->gross_weight?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Poids Net
                                </th>
                                <td>
                                    {{$magasinage->net_weight?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Emballage
                                </th>
                                <td>
                                    {{$magasinage->packaging->name?? ''}}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Nombre
                                </th>
                                <td>
                                    {{$magasinage->number?? ''}}
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <h4>Prestations</h4>
                        <table class=" table table-bordered table-striped table-hover">
                            <thead class="text-white bg-dark">
                            <tr>
                                <th>Prestation</th>
                                <th>Prix</th>
                                <th>Commentaire</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($magasinageServices as $key => $service)
                                <tr>
                                    <td>{{$service->service->name ?? '' }}</td>
                                    <td>{{$service->price ?? '' }}</td>
                                    <td>{{$service->comment ?? '' }}</td>
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

        </div>






{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> --}}
<script src="{{ asset('libs/jquery-ui/toastr.min.js')}}"></script>
<script src="{{ asset('libs/jquery-ui/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('libs/jquery-ui/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>



</body>

</html>





