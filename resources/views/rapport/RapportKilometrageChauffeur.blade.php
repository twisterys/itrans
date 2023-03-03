<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
      
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
       
    </style>
    
    
</head>
<body>

<table>
    <thead>
    <tr>
        
        <th style="font-weight: 700;">Nom</th>
        <th style="font-weight: 700;">Prénom</th>
        <th style="font-weight: 700;">Cin</th>
        <th style="font-weight: 700;">Kilométrage</th>
        <th style="font-weight: 700;">Nombre de jour à l'étranger</th>
        <th style="font-weight: 700;">Nombre de jour au maroc</th>
        <th style="font-weight: 700;">Nombre Import</th>
        <th style="font-weight: 700;">Nombre Export</th>
        <th style="font-weight: 700;">Nombre National</th>
        <th style="font-weight: 700;">Frais Etranger</th>
        <th style="font-weight: 700;">Frais Maroc</th>
      
    </tr>
    </thead>
    <tbody>
        
        
        @foreach ($rapports as $rapport)
            <tr>
                <th>{{$rapport->nom}}</th>
                <th>{{$rapport->prenom}}</th>
                <th>{{$rapport->cin}}</th>
                <td>{{$rapport->sum_kilometrage}}</td>
                <td>{{$rapport->nbJour_etranger}}</td>
                <td>{{$rapport->nbJour_maroc}}</td>
                <td>{{$rapport->nb_import}}</td>
                <td>{{$rapport->nb_export}}</td>
                <td>{{$rapport->nb_national}}</td>
                <td>{{$rapport->frais_etranger}}</td>
                <td>{{$rapport->frais_maroc}}</td>
                
            </tr>
        @endforeach
   
   
    </tbody>
</table>

    
</body>
</html>