@extends('layout.init')

@section('alternalCSS')
    @include('include.dropzoneFile')

@endsection
@endsection

@section('content')

    @include('partials.principal.headerPrincipal')
    @if(Auth::user()->getIsASystemGod())
        @include('partials.admin.ModalCreateLocal')
    @endif
@endsection
@section('alternalJS')
    <script src="{{asset('js/functionsAdmin.js')}}"></script>

    <script>
        $("#create_local").openModal({
            dismissible: false, // Modal can be dismissed by clicking outside of the modal
            opacity: .6
        });

    </script>
@endsection