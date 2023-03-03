@extends('layouts.master-layouts')

@section('title') Permissions @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/jquery-ui/dropzone.min.css')}}" rel="stylesheet" />

    @endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Ajouter Permission  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('permission.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group row">
                                                    <label for="example-text-input" class="col-md-3 col-form-label">Nom</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" type="text" value="{{old('name')}}" id="example-text-input">
                                                        @if($errors->has('name'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('name') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-1">
                                                <button type="submit" class="btn btn-info">Ajouter</button>
                                            </div>
                                        </div>

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
    <script src="{{asset('libs/select2/select2.min.js')}}"></script>
    <script src="{{asset('js/pages/form-advanced.init.js')}}"></script>

    @endsection
