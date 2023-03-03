@extends('layouts.master-layouts')

@section('title') Magasinages @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('libs/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
@endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Afficher Magasinage  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


     <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-white">
                    <a class="btn btn-secondary pull-right" href="{{route('magasinage.index')}}">
                        Retour à la liste
                    </a>
                    <hr>
                </div>

                <div class="card-body">


                    <div class="row">
                        <div class="col-6">

                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class="col-6">
                            <table class="table table-bordered table-striped">
                                <tbody>

                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <td>

                                        </td>
                                    </tr>


                                    <tr>
                                        <th>
                                            Fichier
                                        </th>
                                        <td>
                                            <ul>
                                                @forelse ($magasinage->magasinage_file as $key => $media)
                                                    <li>
                                                            <a href="{{ $media->getUrl() }}" target="_blank"><img src="https://i.ibb.co/m6m7hXh/pdf.png" width="30px">
                                                            {{ $media->name ?? ''  }}
                                                            </a>
                                                    </li>
                                                @empty
                                            </ul>
                                                    Y'a pas de fichier
                                                @endforelse
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>

    @endsection

@section('script')



@endsection
