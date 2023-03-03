@can('view', App\Person::class)
    <a href="{{$showLink}}" class="btn btn-info btn-sm ">Afficher</a>
@endcan
@can('update', App\Person::class)
    <a href="{{$editLink}}" class="btn btn-warning btn-sm ">Modifier</a>
@endcan
@can('delete', App\Person::class)
    <button type="button" class="btn btn-danger btn-sm delete-form" onclick="{{$deleteLink}}">Supprimer</button>
@endcan
