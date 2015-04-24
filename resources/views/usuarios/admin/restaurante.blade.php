@extends('layout.dashboard')
@section('title') Estadisticas @endsection
@section('Restaurante') active @endsection
@section('infoPanel')
{{dd($local)}}
@foreach($local as $datos)

    <div class="card large">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" style="width: 360px: height: 260px" src="{{asset('images/local/'.$datos['id_local'].'/'.$datos['image'])}}">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">{{$datos['name']}}<i class="mdi-navigation-more-vert right"></i></span>
                <br><span class="grey-text text-darken-4 card-title">Numero de mesas: {{$datos['number_tables']}}</span>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4"> <i class="mdi-navigation-close right"></i></span>
                <span class="card-title grey-text text-darken-4">Dueño : {{$datos['owner']}}  </span>
                <div class="row">
                    <a href="#" class="btn tooltipped col s12 offset-s4 l2 offset-l1 EditLocal" data-position="top" data-delay="50" data-tooltip="Editar" data-id="{{$datos['id_local']}}"><i class="tiny mdi-editor-mode-edit "></i></a>

                </div>
            </div>
        </div>
    </div>
@endforeach
@include('partials.admin.ModalEditLocal')

@endsection