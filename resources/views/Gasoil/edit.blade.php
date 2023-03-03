@extends('layouts.master-layouts')

@section('title') Gasoil @endsection
@section('css')

 <!-- DataTables -->
 <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
 <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
 <link href="{{ asset('libs/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet"/>



@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Modifier Gasoil @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('gasoil.update',$gasoil->id)}}" class="form-horizontal form-wizard-wrapper" autocomplete="off" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <x-form-gasoil :gasoil="$gasoil" :stations="$stations" :vehicles="$vehicles" :drivers="$drivers">Modifier</x-form-gasoil>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

    @endsection

@section('script')





    <script src="{{ asset('libs/select2/select2.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>

    <script src="{{ asset('libs/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- form advanced init -->
    <script src="{{asset('js/pages/form-advanced.init.js')}}"></script>




@endsection
