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
        <th style="font-weight: 700;">Numéro série</th>
        <th style="font-weight: 700;">Prêter de</th>
        <th style="font-weight: 700;">Prêter pour</th>
        <th style="font-weight: 700;">Defaillante</th>
        
    </tr>
    </thead>
    <tbody>
        
        
    @foreach($plomos as $plomo)
        <tr>
            <td style="text-align: center;">{{ $plomo->num_serie }}</td>
            <td style="text-align: center;">{{ $plomo->traiter_de }}</td>
            <td style="text-align: center;">{{ $plomo->traiter_a }}</td>
            <td style="text-align: center;">
                @if ($plomo->defaillante)
                    Oui
                @else
                    Non
                @endif
            </td>
            
        </tr>
    @endforeach
    <tr></tr>
    <tr>
        <td></td>
        <td></td>
        <td style="font-weight: 700;text-align: center;border:solid 10px;border-right: none;">Reste</td>
        <td style="font-weight: 700;text-align: center;border:solid 10px;border-left: none;">{{$rest_plomos}}</td>
    </tr>
    </tbody>
</table>

    
</body>
</html>