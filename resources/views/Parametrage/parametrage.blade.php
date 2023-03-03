@extends('layouts.master-layouts')

@section('title') Paramétrages @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/jquery-ui/dropzone.min.css')}}" rel="stylesheet" />

    @endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Modifier les paramétres   @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('parametrage.editExpiration',$parametrage->id)}}">
                                        @csrf
                                        @method('PUT')
                                       <div class="row">
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="example-number-input" class="col-md-3 col-form-label">Expiration de véhicule<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                                                    <div class="col-md-9">
                                                        <input class="form-control {{ $errors->has('expiration') ? 'is-invalid' : '' }}" name="expiration" type="number" value="{{old('expiration',$parametrage->expiration)}}" id="example-number-input">
                                                        @if($errors->has('expiration'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('expiration') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group row">
                                                    <label for="example-number-input" class="col-md-3 col-form-label">Scelles douane<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                                                    <div class="col-md-9">
                                                        <input class="form-control {{ $errors->has('plomos_expiration') ? 'is-invalid' : '' }}" name="plomos_expiration" type="number" value="{{old('plomos_expiration',$parametrage->plomos_expiration)}}" id="example-number-input">
                                                        @if($errors->has('plomos_expiration'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('plomos_expiration') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                       </div>
                                       <div class="float-right">
                                            <button class="btn btn-primary">Modifier</button>
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


    @endsection
