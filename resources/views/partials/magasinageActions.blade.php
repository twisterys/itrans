@can('update', App\Magasinage::class)
    <a href="{{$editLink}}" class="btn btn-warning btn-sm mr-1">Modifier</a>
@endcan
@can('delete', App\Magasinage::class)
    <button type="button" class="btn btn-danger btn-sm mr-1 delete-form" onclick="{{$deleteLink}}">Supprimer</button>
@endcan
