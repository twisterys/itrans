@can('view', App\Vehicle::class)
    <a href="{{$showLink}}" class="btn btn-info btn-sm mr-1">Afficher</a>
@endcan
@can('update', App\Vehicle::class)
    <a href="{{$editLink}}" class="btn btn-warning btn-sm mr-1">Modifier</a>
@endcan
@can('delete', App\Vehicle::class)
    <button type="button" class="btn btn-danger btn-sm mr-1 delete-form" onclick="{{$deleteLink}}">Supprimer</button>
@endcan