@can('update', App\User::class)
    <a href="{{$editLink}}" class="btn btn-warning btn-sm mr-1">Modifier</a>
@endcan
@can('delete', App\User::class)
    <button type="button" class="btn btn-danger btn-sm mr-1 delete-form" onclick="{{$deleteLink}}">Supprimer</button>
@endcan