@extends('layout.dashboard')
@section('title') Estadisticas @endsection
@section('Restaurante') active @endsection
@section('infoPanel')

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
                <p></p>
            </div>
        </div>
    </div>
@endforeach


@endsection