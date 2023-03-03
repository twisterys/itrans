@extends('layouts.master-layouts')

@section('title') Utilisateures @endsection
@section('css')

    <!-- DataTables -->
    <link href="{{ asset('libs/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-touchspin/bootstrap-touchspin.min.css')}}" rel="stylesheet" />
    <link href="{{ asset('libs/jquery-ui/dropzone.min.css')}}" rel="stylesheet" />

    @endsection

@section('content')

    @component('common-components.breadcrumb')
         @slot('title') Modifier Utilisateur  @endslot
         @slot('li_1') Tables  @endslot
     @endcomponent


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <p class="card-title-desc">
                                    </p>

                                    <form method="POST" action="{{route('user.update',$user->id)}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <x-form-user :user="$user" :permissions="$permissions">Modifier</x-form-user>
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


    <script>
        $(document).ready(function() {
            $(".select-all").click(function(){
                $("#e1").find('option').prop("selected",true);
                $("#e1").trigger('change');

            });
            $(".deselect-all").click(function(){
                $("#e1").find('option').prop("selected",false);
                    $("#e1").trigger('change');

            });
        });
    </script>
    @endsection
