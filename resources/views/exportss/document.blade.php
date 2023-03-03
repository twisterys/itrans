@extends('layouts.master-layouts')

@section('title') Export @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />

    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>

    <link href="{{ asset('libs/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>

    <link href="{{ asset('libs/jquery-ui/dropzone.min.css')}}" rel="stylesheet" />

@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title')  Export Documents  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"> Ajouter des fichiers</h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('export.store_docs')}}" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="dossier_id" id="dossier_id" value="{{$export->id}}"/>
                                       <span id="error-dropzone"></span>
                                       <div class="form-group">
                                        <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="doc-dropzone">
                                        </div>
                                        @if($errors->has('file'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('file') }}
                                            </div>
                                        @endif
                                    </div>
                                        <span class="help-block"></span>
                                        <div class="form-group">
                                            <button class="btn btn-success" type="submit">
                                                Mettre à jour
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                         <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Fichiers</h4>
                                    <p class="card-title-desc">
                                    </p>
                                    @if ($export->export_file->count()>0)


                                     <table class="table table-bordered table-striped">
                                        @foreach($export->export_file as $key => $media)
                                         <tr>
                                             <td>
                                                <a href="{{ $media->getUrl() }}" target="_blank"><img src="https://i.ibb.co/m6m7hXh/pdf.png" width="30px">
                                                {{ $media->name ?? ''  }}
                                                </a>
                                             </td>
                                             <td>
                                                <button type="button" class="btn btn-danger btn-sm  delete-form" data-toggle="tooltip" title="Supprimer" onclick="deleteDoc({{$media->id}})"><i class="dripicons-document-delete"></i></button>
                                             </td>
                                         </tr>
                                         @endforeach
                                     </table>

                                     @else
                                     <div class="row col-12">
                                        <h4 class="mt-3 mx-auto alert alert-danger">Pas des fichiers pour cet export </h4>
                                        {{-- <span class="alert alert-danger">pas des fichiers</span> --}}
                                     </div>

                                     @endif
                                    {{-- <td>
                                       <a href="{{ $media->getUrl() }}" target="_blank"><img src="https://i.ibb.co/m6m7hXh/pdf.png" width="30px">
                                            {{ explode('_',$media->name)[0].'_'.$media->created_at->format('d/m/Y')  }}
                                            {{ $media->name ?? ''  }}
                                        </a><br/>
                                  </td> --}}

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

    @endsection

@section('script')

    <script src="{{ asset('libs/select2/select2.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>

    <script src="{{ asset('libs/jquery-ui/jquery-ui.min.js')}}"></script>

    <script src="{{ asset('libs/jquery-ui/dropzone.min.js')}}"></script>

<script>
     var uploadedexportFileMap = {}
Dropzone.options.docDropzone = {
    dictRemoveFile: "Supprimer",
    dictCancelUpload : "Annuler le chargement",
    acceptedFiles : "application/pdf" ,
    dictDefaultMessage:  "<i class='mdi mdi-upload-network-outline'></i> Glisser ou double click pour charger le fichier" ,
    dictFallbackMessage: "Votre navigateur ne prend pas en charge le glisser-déposer de fichiers.",
    dictFallbackText: "Utilisez le formulaire ci-dessous pour télécharger vos fichiers.",
    dictInvalidFileType: "Vous ne pouvez pas télécharger des fichiers de ce type.",
    dictCancelUpload: "Abandonner le chargement",
    dictUploadCanceled: "Chargement interrompu.",
    dictCancelUploadConfirmation: "Vous êtes sûr de vouloir interrompre le téléchargement?",
    dictRemoveFileConfirmation: null,
    dictMaxFilesExceeded: "Vous ne pouvez pas télécharger plus de fichiers.",
    url: '{{ route('import.storeMedia') }}',
    maxFilesize: 15, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 15
    },
    success: function (file, response) {
        $('form').append('<input type="hidden" name="file[]" value="' + response.name + '">')
        uploadedexportFileMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedexportFileMap[file.name]
      }
      $('form').find('input[name="file[]"][value="' + name + '"]').remove()
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         $( "#error-dropzone" ).append("<br><p class='alert alert-danger'>"+message+"</p>" )
        //  file.previewElement.classList.add('dz-success-mark')
        //  file.previewElement.classList.add('dz-error')
        //  _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        //  _results = []
        //  for (_i = 0, _len = _ref.length; _i < _len; _i++) {
        //      node = _ref[_i]
        //      _results.push(node.textContent = message)
        //  }

        //  return _results
     }
}

function deleteDoc(id){

    swal.fire({
    title: "Supprimé?",
    icon: 'question',
    text: "Voulez vous vraiment supprimer ce document!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonText: "Oui, Supprimer!",
    cancelButtonText: "Non, annuler!",
    reverseButtons: !0
}).then(function (e) {
    if (e.value === true) {
        //alert('hi');
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var url = '{{ route("doc.delete", ":doc") }}';
        url = url.replace(':doc', id);
        $.ajax({
            type: 'DELETE',
            url: url,
            data: {_token: CSRF_TOKEN},
            dataType: 'JSON',
            success: function (results) {
                if (results.success === true) {

                    location.reload();
                } else {
                    swal.fire("Error!", results.message, "error");
                }
            },
            error: function(error) {
                console.log(error)
            }
        });

    } else {
        e.dismiss;
    }

}, function (dismiss) {
    return false;
})
}
</script>
@endsection
