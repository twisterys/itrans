@extends('layouts.master-layouts')

@section('title') Type Emballages @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />

@endsection

@section('content')

    @component('common-components.breadcrumb')
        @slot('title') Ajouter Type Emballage  @endslot
        @slot('li_1') Tables  @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title"></h4>
                    <p class="card-title-desc">
                    </p>

                    <form method="POST" action="{{route('TypePackaging.store')}}">
                        @csrf
                        <x-form-type-packaging :typePackaging=null>Ajouter</x-form-type-packaging>
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

@endsection
