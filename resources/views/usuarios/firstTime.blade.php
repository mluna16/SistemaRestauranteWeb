@extends('layout.init')

@section('alternalCSS')
    @include('include.dropzoneFile')

@endsection

@section('content')

    @include('partials.principal.headerPrincipal')
    @if(Auth::user()->getIsASystemGod())
        @include('partials.admin.ModalCreateLocal')
    @else
        @include('partials.principal.ModalChangePassword')
    @endif
@endsection
@section('alternalJS')
    @if(Auth::user()->getIsASystemGod())
        <script src="{{asset('js/functionsAdmin.js')}}"></script>

        <script>
            $("#create_local").openModal({
                dismissible: false,
                opacity: .6
            });

        </script>
    @else
        <script src="{{asset('js/functionsUser.js')}}"></script>
        <script>
            $("#changePassword").openModal({
                dismissible: false,
                opacity: .6
            });

        </script>
    @endif
@endsection