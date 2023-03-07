<div style="white-space :nowrap">
    @can('view', App\Magasinage::class)
        <a href="{{$showLink}}" class="btn btn-info btn-sm " title="Afficher"><i class="fa fa-eye"></i></a>
    @endcan
    @can('update', App\Magasinage::class)
        <a href="{{$editLink}}" class="btn btn-warning btn-sm " title="Modifier"><i class="fa fa-edit"></i> </a>
    @endcan
    @can('delete', App\Magasinage::class)
        <button type="button" class="btn btn-danger btn-sm  delete-form" onclick="{{$deleteLink}}" title="Supprimer"><i class="fa fa-trash"></i> </button>
    @endcan
    @can('view', App\Magasinage::class)
        <a href="{{$downloadLink}}" class="btn btn-light btn-sm " title="Télécharger"><i class="fa fa-download"></i> </a>
    @endcan
</div>
