@extends('layout.dashboard')
@section('title') Estadisticas @endsection
@section('Restaurante') active @endsection
@section('infoPanel')
    
    <div class="card large">
        <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
                <img class="activator" style="width: 360px: height: 260px" src="">
            </div>
            <div class="card-content">
                <span class="card-title activator grey-text text-darken-4">El restaurante<i class="mdi-navigation-more-vert right"></i></span>
                <br><span class="grey-text text-darken-4 card-title">Numero de mesas</span>
                <p data-id=""><a href="#">Editar</a></p>
            </div>
            <div class="card-reveal">
                <span class="card-title grey-text text-darken-4"> <i class="mdi-navigation-close right"></i></span>
                <span class="card-title grey-text text-darken-4">Dueño :  </span>
                <p></p>
            </div>
        </div>
    </div>


@endsection