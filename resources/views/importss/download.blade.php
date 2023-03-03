<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="{{ public_path('css/bootstrap.min.css')}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
    <title> Dossier {{ $import->id }}</title>
    <style>
    </style>
</head>

<style>

body {
color: black;
background-color: white;
size: 10px;
font-size: 15px;
font-family: 'Nunito', sans-serif;
}


fieldset{
    border: 1px;
}
/**/
footer {
       position: fixed;
        bottom: 0cm;
        left: 0cm;
        right: 0cm;
        height: 2cm;
}
/**/
/**/
</style>
<body>
    <div>
        <img src="{{public_path('images/logo-mega.png')}}" class="img" height="60px" width="80px"/>
    </div>
    <div class="">
        <p class="float-right" style="font-size: 15px;">
            Tanger Le : {{$import->date ?? ''}}
        </p>
    </div>

    <div class="row mt-5">

            <table class="" >
                <tr class="">
                    <th>Dossier N°  </th>
                    <td ><span class="mr-3 ml-3" style="font-size: 20px;">:</span> {{$import->id ?? ''}} </td>
                </tr>
                <tr class="">
                    <th>Chauffeurs </th>
                    <td><span class="mr-3 ml-3" style="font-size: 20px;">:</span>
                        @foreach ($import->chauffeur as $item)
                            <span class="badge bg-primary text-white">{{$item->nom.' '.$item->prenom.'('.$item->cin.')'}}</span>
                        @endforeach
                     </td>
                </tr>
                <tr class="">
                    <th>Matricule </th>
                    <td><span class="mr-3 ml-3" style="font-size: 20px;">:</span>
                        @foreach ($import->dossierVehicles as $item)
                            <span class="badge bg-primary text-white">{{$item->vehicles ? $item->vehicles->N_immatriculation.'('.$item->TypeVehicle->name.')' : $item->matricule.'('.$item->TypeVehicle->name.')' }}</span>
                        @endforeach
                     </td>
                </tr>

                <tr class="">
                    <th>Compagnie</th>
                    <td><span class="mr-3 ml-3"  style="font-size: 20px;">:</span>{{$import->compagnie ?? ''}} </td>
                </tr>
                @if ($import->type == 'import')
                    <tr class="">
                        <th >BL  </th>
                        <td><span class="mr-3 ml-3" style="font-size: 20px;">:</span>{{$import->num_connaissement ?? ''}}</td>
                    </tr>
                @endif
            </table>
    </div>
    <div class="row mt-5">
        <h5 class="mx-auto text-center" style="text-transform: uppercase;">detail {{$import->type ?? ''}}</h5>
        <table class=" table table-bordered table-striped table-hover" style="table-layout:fixed;">
            <thead class="text-white bg-dark">
                <tr>
                    <th class="text-center">Client</th>
                    <th class="text-center">Transitaire</th>
                    <th class="text-center">Importateur</th>
                    <th class="text-center">Exportateur</th>
                    <th class="text-center">Nbre Colis</th>
                    <th class="text-center">Marchandise</th>
                    <th class="text-center">Poids Brute</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($import->dossierItems as $item)
                    <tr>
                        <td style="width:100%;">{{$item->client ? $item->client->nom : ''}}</td>
                        <td style="width:100%;">{{$item->transitaire ? $item->transitaire->nom : ''}}</td>
                        <td style="width:100%;">{{$item->importateur ?? ''}}</td>
                        <td style="width:100%;">{{$item->exportateur ??  ''}}</td>
                        <td style="width:100%;">{{$item->numb_colis ?? ''}}</td>
                        <td style="width:100%;">{{$item->marchandise ?? ''}}</td>
                        <td style="width:100%;">{{$item->poid_brute ?? ''}}</td>
                    </tr>
                @endforeach

            </tbody>
    </table>
    @if ($import->dossierItems)
    <table class="table table-bordered  table-hover float-right" style="width: 43%;">
        <tr class="">
            <th class="bg-dark text-white">Total Colis  </th>
            <td > {{$import->nbr_colis ?? ''}} </td>
        </tr>
        <tr class="">
            <th class="bg-dark text-white">Total Poids </th>
            <td> {{$import->poid_brut ?? ''}} </td>
        </tr>
    </table>
    @endif
    </div>


    <footer>
        <p  class="text-center">Mega Cargo Castilla Tanger</p>
    </footer>

</body>


</html>
