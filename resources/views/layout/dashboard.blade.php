@extends('layout.init')

@section('alternalCSS')
    @include('include.dropzoneFile')

@endsection
@section('content')

    @include('partials.principal.headerPrincipal')
    <div class="row">
        <div class="col s12 m2 l2 "data-step="1" data-intro="@yield('TextoTour')" data-position='right'>
            <div class="row fixed ">
                <div class="collection light-blue lighten-1">
                    <a href="{{ url('admin/Estadisticas') }}" class="collection-item @yield('Estadisticas') ">Estadísticas</a>
                    <a href="{{ url('admin/Usuarios') }}" class="collection-item @yield('Usuarios')">Usuarios</a>
                    <a href="{{ url('admin/Menu') }}" class="collection-item @yield('Menu')">Menú</a>
                    <a href="{{ url('admin/Restaurante') }}" class="collection-item @yield('Restaurante')">Restaurante</a>
                </div>
            </div>
        </div>
        <div class="col s12 m10 l10">
            <div class="row">
                <div class="col m11 l11" id="principalPanel">
                    @section('infoPanel')

                    @show
                </div>
                <div class="col m1 s1" >
                    <div class="fixed-action-btn" data-step="@yield('numeroBotonFlotante')" data-intro="Permite agregar un nuevo producto o un nuevo usuario al sistema. Esta función esta disponible en todos los módulos del sistema" data-position='left'>
                        <a class="btn-floating btn-large light-blue lighten-1">
                            <i class="large mdi-content-add"></i>
                        </a>
                        <ul>
                            <li><a class="btn-floating  purple lighten-1 modal-trigger" id="create_user_modal" href=""><i class="large mdi-image-timer-auto"></i></a></li>
                            <li><a class="btn-floating green darken-1 modal-trigger" id ="create_menu_modal" href=""><i class="large mdi-maps-local-restaurant"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="modalPrincipal">

    </div>
    @if(Auth::user()->type == 'admin')
        {{--@include('partials.admin.ModalCreateMenu')--}}
    @endif

@endsection
@section('alternalJS')
    <script src="{{asset('js/functionsAdmin.js')}}"></script>
    <script src="{{asset('js/charts.js')}}"></script>

@endsection

