@extends('layouts.master-layouts')

@section('title') Depot @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Ajouter Depot  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('depot.store')}}">
                                        @csrf
                                        <x-form-depot :depot=null>Ajouter</x-form-depot>
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
    <script src="{{ asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.js')}}"></script>
    <script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
@endsection
