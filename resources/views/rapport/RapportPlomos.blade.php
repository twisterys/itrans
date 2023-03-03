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
        <tbody>
            <tr>
                <td style="font-weight: 900;color:red">Stock Actuelle</td>
                <td style="font-weight: 900;color:red">{{$rest_plomos}}</td>
            </tr>
        </tbody>
    </table>
<table>
    <thead>
    <tr>
        <th style="font-weight: 700;">Plomos</th>
        <th style="font-weight: 700;">Dum</th>
    </tr>
    </thead>
    <tbody>
        
        
        @foreach ($rapports as $rapport)
            <tr>
                <td>{{$rapport['plomo']}}</td>
                <td>{{$rapport['dum']}}</td>
                
            </tr>
        @endforeach
   
   
    </tbody>
</table>

    
</body>
</html>