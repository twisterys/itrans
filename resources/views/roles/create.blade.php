@extends('layouts.master-layouts')

@section('title') Roles @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/jquery-ui/dropzone.min.css')}}" rel="stylesheet" />

    @endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Ajouter Role  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('role.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-4">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="col-md-3 col-form-label">Ville</label>
                                                <div class="col-md-9">
                                                    <input class="form-control {{ $errors->has('ville') ? 'is-invalid' : '' }}" name="ville" type="text" value="{{old('ville',$station ? $station->ville : '')}}" id="example-text-input">
                                                    @if($errors->has('ville'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('ville') }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group row">
                                                    <label class="col-md-3 col-form-label">Permissions</label>
                                                    <div class="col-md-9">
                                                        <select name="plomos[]" class="select2 form-control select2-multiple " multiple="multiple" data-placeholder="Choisir ...">

                                                                @foreach ($plomos as $plomo)
                                                                    <option value="{{$plomo->id}}" {{ in_array($plomo->id, old('plomos', [])) || ($import ? $import->dossierPlomos->contains($plomo->id) : null) ? 'selected' : '' }}>{{$plomo->num_serie}}</option>
                                                                @endforeach

                                                        </select>
                                                </div>
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
