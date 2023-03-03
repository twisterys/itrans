@extends('layouts.master-layouts')

@section('title') Rapport/Kilométrage @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Kilométrage  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('rapport.calculKilometrage')}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group ">
                                                    <label for="type_rapport">Type de Rapport<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>
                                                        <select class="custom-select {{ $errors->has('type_rapport') ? 'is-invalid' : '' }}" name="type_rapport" id="type_rapport">
                                                            <option value="" selected>Open this select menu</option>
                                                            @foreach(App\Rapport::TYPE_RAPPORT as $key => $label)
                                                                <option value="{{ $key }}" {{ old('type_rapport', $type_rapport ? $type_rapport : '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('type_rapport'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('type_rapport') }}
                                                            </div>
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <label for="example-date-input">Premiére Date<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>

                                                        <input class="form-control {{ $errors->has('first_date') ? 'is-invalid' : '' }}" name="first_date" type="date" value="{{old('first_date',$first_date ? $first_date : '')}}" id="example-date-input">
                                                        @if($errors->has('first_date'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('first_date') }}
                                                            </div>
                                                        @endif

                                                </div>
                                            </div>
                                            <div class="col-3">
                                                <div class="form-group ">
                                                    <label for="example-date-input">Deuxiéme Date<span>(<i style="font-size: 6px;" class="fas fa-asterisk text-danger"></i>)</span></label>

                                                        <input class="form-control {{ $errors->has('second_date') ? 'is-invalid' : '' }}" name="second_date" type="date" value="{{old('second_date',$second_date ? $second_date : '')}}" id="example-date-input">
                                                        @if($errors->has('second_date'))
                                                            <div class="invalid-feedback">
                                                                {{ $errors->first('second_date') }}
                                                            </div>
                                                        @endif

                                                </div>
                                            </div>
                                            <div class="col-2 mt-4">

                                                <button class="btn btn-primary">Génrer Rapport</button>

                                            </div>

                                        </div>
                                    </form>
{{--                                    @if ($rapports)--}}
{{--                                        <div class="card border border-info"">--}}
{{--                                            <div class="card-header bg-info text-white ">--}}
{{--                                                Rapport--}}
{{--                                            </div>--}}
{{--                                            <div class="card-body">--}}

{{--                                                    <div class="row mx-auto">--}}

{{--                                                            <div class="col-12">--}}
{{--                                                                @if ($rapports != '[]')--}}

{{--                                                                <table class=" table table-bordered table-striped table-hover mx-auto" style="width: 80%;">--}}
{{--                                                                    <thead class="text-white bg-dark">--}}
{{--                                                                        <tr>--}}
{{--                                                                            <th class="text-center">Type de dossier</th>--}}
{{--                                                                            <th class="text-center">Type Véhicule</th>--}}
{{--                                                                            <th class="text-center">Matricule</th>--}}
{{--                                                                            <th class="text-center">Kilométrage</th>--}}
{{--                                                                            <th class="text-center">Nombre de jour à l'étranger</th>--}}
{{--                                                                            <th class="text-center">Nombre de jour au maroc</th>--}}
{{--                                                                            <th class="text-center">Nombre de voyage</th>--}}
{{--                                                                        </tr>--}}
{{--                                                                    </thead>--}}
{{--                                                                    <tbody>--}}
{{--                                                                        @foreach ($rapports as $rapport)--}}
{{--                                                                            <tr>--}}
{{--                                                                                <td>{{$rapport->type}}</td>--}}
{{--                                                                                <td>{{$rapport->name}}</td>--}}
{{--                                                                                <td>{{$rapport->N_immatriculation}}</td>--}}
{{--                                                                                <td>{{$rapport->sum_kilometrage}}</td>--}}
{{--                                                                                <td>{{$rapport->nbJour_etranger}}</td>--}}
{{--                                                                                <td>{{$rapport->nbJour_maroc}}</td>--}}
{{--                                                                                <td>{{$rapport->sum_dossier}}</td>--}}
{{--                                                                            </tr>--}}
{{--                                                                        @endforeach--}}
{{--                                                                    </tbody>--}}
{{--                                                                </table>--}}

{{--                                                                @else--}}
{{--                                                                    <div class="text-center">No record</div>--}}
{{--                                                                @endif--}}

{{--                                                            </div>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                    @endif--}}
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
