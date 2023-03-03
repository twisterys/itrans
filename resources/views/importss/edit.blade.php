@extends('layouts.master-layouts')

@section('title') Import @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>

    <script src="{{ asset('libs/jquery-ui/sweetalert2.all.min.js')}}"></script>


@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Modifier Import  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('import.update',$import->id)}}" id="form-horizontal" class="form-horizontal form-wizard-wrapper">
                                        @csrf
                                        @method('PUT')
                                        <x-form-import :drivers="$drivers" :typesFrais="$typeFrais" :typesVehicle="$typeVehicle" :import="$import" :vehicles="$vehicles" :plomos="$plomos" :clients="$clients" :transitaires="$transitaires" :chauffeurs="$chauffeurs">Modifier</x-form-import>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

    @endsection


    @section('script')


    <!-- form wizard -->
   <script src="{{asset('libs/jquery-steps/jquery-steps.min.js')}}"></script>
   <!-- form wizard init -->
   <script src="{{asset('js/pages/form-wizard.init.js')}}"></script>

   <!-- form repeater js -->
   <script src="{{asset('/libs/jquery-repeater/jquery-repeater.min.js')}}"></script>
   <!-- form repeater init -->
   {{-- <script src="{{asset('/js/pages/form-repeater.init.js')}}"></script> --}}


   <script src="{{ asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
  <script src="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>

  <script src="{{ asset('libs/jquery-ui/jquery-ui.min.js')}}"></script>


@endsection
