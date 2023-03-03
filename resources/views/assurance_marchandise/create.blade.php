@extends('layouts.master-layouts')

@section('title') Assurances Marchandise @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/jquery-ui/dropzone.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Ajouter Assurance Marchandise  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('assuranceMarchandise.store')}}" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        <x-form-assurance-marchandise :assurance=null>Ajouter</x-form-assurance-marchandise>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

    @endsection

@section('script')

    <!-- Required datatable js -->
    <script src="{{ asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{ asset('libs/jquery-ui/dropzone.min.js')}}"></script>

    <script>
        var uploadedAssuranceFileMap = {}
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
       url: '{{ route('assuranceMarchandise.storeMedia') }}',
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
           uploadedAssuranceFileMap[file.name] = response.name
       },
       removedfile: function (file) {
         file.previewElement.remove()
         var name = ''
         if (typeof file.file_name !== 'undefined') {
           name = file.file_name
         } else {
           name = uploadedAssuranceFileMap[file.name]
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
   </script>
@endsection
