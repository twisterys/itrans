@extends('layouts.master-layouts')

@section('title') Global Frais @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />


    <style>
        
    </style>
    

@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title')  Global Frais  @endslot
         @slot('li_1') Gestion d'affectations des Frais  @endslot
     @endcomponent

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>
                                <form method="POST" action="{{route('generalFrais.store')}}">
                                        @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                    <label class="col-md-4 col-form-label">Expenses Maroc</label>
                                                        <select name="fraisMaroc" class="select2 form-control select2-multiple "  id="e1" data-placeholder="Choisir ...">
                                                                <option value=""></option>
                                                                @foreach ($freeTypeFrais as $freeTypeFrai)
                                                                   
                                                                    <option value="{{$freeTypeFrai->id}}" {{ in_array($freeTypeFrai->id, old('fraisMaroc', [])) || ($generalMarocFrais ? $generalMarocFrais->id == $freeTypeFrai->general_frais_id : null) ? 'selected' : '' }}>{{$freeTypeFrai->name}}</option>
                                                                    
                                                                @endforeach
                                                        
                                                        </select>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                    <label class="col-md-4 col-form-label">Expenses Etranger</label>
                                                        <select name="fraisEtranger" class="select2 form-control select2-multiple "  id="e2" data-placeholder="Choisir ...">
                                                                <option value=""></option>
                                                                @foreach ($freeTypeFrais as $freeTypeFrai)
                                                                    
                                                                    <option value="{{$freeTypeFrai->id}}" {{ in_array($freeTypeFrai->id, old('fraisEtranger', [])) || ($generalEtrangerFrais ? $generalEtrangerFrais->id == $freeTypeFrai->general_frais_id : null) ? 'selected' : '' }}>{{$freeTypeFrai->name}}</option>
                                                                    
                                                                @endforeach
                                                        </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-info float-right mt-3">Affecter</button>
                                </form>
                                        
                                    
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

    @endsection

@section('script')
<!-- Using a local copy -->
{{-- <script src="multiselect.min.js"></script> --}}

<script src="{{ asset('libs/select2/select2.min.js')}}"></script>
<script src="{{ asset('js/pages/form-advanced.init.js')}}"></script>

<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

<script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<!-- Using a CDN -->
<script src="https://cdn.rawgit.com/crlcu/multiselect/master/dist/js/multiselect.min.js"></script>
<script>
    $(document).ready(function() {
	    $('#mySideToSideSelect').multiselect();
    });
</script>






@endsection
