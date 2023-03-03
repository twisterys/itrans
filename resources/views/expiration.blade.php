@extends('layouts.master-layouts')

@section('title') Dashboard @endsection

@section('content')
    @component('common-components.breadcrumb')
         @slot('title') Licence   @endslot
         @slot('title_li') Licence   @endslot
     @endcomponent

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <h1>
                Votre Licence a été expiré
            </h1>
        </div>
    </div>
    </div>

</div>
<!-- end row -->

@endsection

@section('script')
@endsection
