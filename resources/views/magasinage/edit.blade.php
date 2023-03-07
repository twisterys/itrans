@extends('layouts.master-layouts')

@section('title') Magasinages @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/jquery-ui/dropzone.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Modifier Magasinage  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('magasinage.update',$magasinage->id)}}" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <x-form-magasinage :magasinage="$magasinage" :depots="$depots" :plomos="$plomos"  :clients="$clients" :packages="$packages" :services="$services" :magasinageServices="$magasinageServices" :magasinageService="$magasinageService">Modifier</x-form-magasinage>
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
     <!-- form advanced init -->
     <script src="{{ asset('libs/select2/select2.min.js')}}"></script>
     <script src="{{asset('js/pages/form-advanced.init.js')}}"></script>

    <script>
        $(document).on('click', '.btn_add_row', function()
        {
            cloneRow('item_table');

        });
        $(document).on('click', '.delete_row', function(){
            $(this).parents('tr').remove();
        });


        var count = "1";
        var c = 1;
        function cloneRow(in_tbl_name)
        {
            var tbody = document.getElementById(in_tbl_name).getElementsByTagName("tbody")[0];
            // create row
            var row = document.createElement("tr");
            // create table cell 1
            var td1 = document.createElement("td");
            var strHtml1 = '<span class="btn btn-danger btn-sm btn-xs delete_row"><i class="fa fa-minus"></i><input type="hidden" name="item_id" id="item_id" value=""><input type="hidden"  value="{{ null }}"></span>';
            td1.innerHTML = strHtml1.replace(/!count!/g,count);

            var td3 = document.createElement("td");
            var strHtml3 = '<select class="custom-select {{ $errors->has('service_id') ? 'is-invalid' : '' }}" name="services[]" id="services[]" required>      @foreach($services as $key => $label)        <option value="{{ $label->id }}">{{ $label->name }}</option>    @endforeach</select></div>';
            td3.innerHTML = strHtml3.replace(/!count!/g,count);

            var td4 = document.createElement("td");
            var strHtml4 = '<input type="hidden"  "><input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price[]" id="price" value="" step=0.01>';
            td4.innerHTML = strHtml4.replace(/!count!/g,count);

            var td5 = document.createElement("td");
            var strHtml5 = '<input type="hidden"  "><input class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}" type="text" name="comment[]" id="comment" value="">';
            td5.innerHTML = strHtml5.replace(/!count!/g,count);

            var td6 = document.createElement("td");
            var strHtml6 = '';
            td6.innerHTML = strHtml6.replace(/!count!/g,count);

            // append data to row
            row.appendChild(td1);

            row.appendChild(td3);

            row.appendChild(td4);

            row.appendChild(td5);

            row.appendChild(td6);


            // add to count variable
            count = parseInt(count) + 1;
            // append row to table
            tbody.appendChild(row);
            row.className = 'item';
        }

    </script>
    <script>
        var uploadedAssuranceFileMap = {}
   Dropzone.options.docDropzone = {
       dictRemoveFile: "Supprimer",
       dictCancelUpload : "Annuler le chargement",
       acceptedFiles : "image/jpeg,image/png,image/jpg,image/gif,application/pdf" ,
       dictDefaultMessage:  "<i class='mdi mdi-upload-network-outline'></i> Glisser ou double click pour charger les fichiers" ,
       dictFallbackMessage: "Votre navigateur ne prend pas en charge le glisser-déposer de fichiers.",
       dictFallbackText: "Utilisez le formulaire ci-dessous pour télécharger vos fichiers.",
       dictInvalidFileType: "Vous ne pouvez pas télécharger des fichiers de ce type.",
       dictCancelUpload: "Abandonner le chargement",
       dictUploadCanceled: "Chargement interrompu.",
       dictCancelUploadConfirmation: "Vous êtes sûr de vouloir interrompre le téléchargement?",
       dictRemoveFileConfirmation: null,
       dictMaxFilesExceeded: "Vous ne pouvez pas télécharger plus de fichiers.",
       url: '{{ route('magasinage.storeMedia') }}',
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
        },
        init: function () {
            @if(isset($magasinage) && $magasinage->magasinage_file)
                    var files =
                        {!! json_encode($magasinage->magasinage_file) !!}
                        for (var i in files) {
                        var file = files[i]
                        this.options.addedfile.call(this, file)
                        file.previewElement.classList.add('dz-complete')
                        $('form').append('<input type="hidden" name="file[]" value="' + file.file_name + '">')
                        }
            @endif
        },
   }
   </script>
@endsection
