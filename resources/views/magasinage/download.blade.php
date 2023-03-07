<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ public_path('css/bootstrap.min.css')}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
    <title> Dossier {{ $magasinage->id }}</title>
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
        Date Entrée : {{ $magasinage->date_entree }}
    </p>
</div>

<div class="row mt-5">

    <table class="" >
        <tr class="">
            <th>Dossier N°  </th>
            <td ><span class="mr-3 ml-3" style="font-size: 20px;">:</span> {{$magasinage->id ?? ''}} </td>
        </tr>
    </table>
</div>

    <div class="visible-print text-center" style="margin-top: 8%">
<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(400)->generate(url('afficherPublic', $magasinage->id))) !!} ">
</div>


<footer>
<p  class="text-center">Mega Cargo Castilla Tanger</p>
</footer>

</body>


</html>
