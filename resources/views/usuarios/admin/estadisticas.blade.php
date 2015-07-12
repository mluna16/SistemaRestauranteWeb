@extends('layout.dashboard')
@section('title') Estadisticas @endsection
@section('Estadisticas') active @endsection

@section('infoPanel')
    <div class="row">
        <div class="col s12 m6 l6">
            <div class="card">
                <div class="card-image">
                    <div id="productosDia"></div>                </div>
                <div class="card-action">
                    <span class="card-title blue-text text-darken-2">Productos dia</span>

                </div>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <div class="card">
                <div class="card-image">
                    <div id="productosSemana"></div>                </div>
                <div class="card-action">
                    <span class="card-title blue-text text-darken-2">Productos Semana</span>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12 m6 l6">
            <div class="card">
                <div class="card-image">
                    <div id="productosMes"></div>                </div>
                <div class="card-action">
                    <span class="card-title blue-text text-darken-2">Productos Mes</span>

                </div>
            </div>
        </div>
        <div class="col s12 m6 l6">
            <div class="card">
                <div class="card-image">
                    <div id="productosAno"></div>                </div>
                <div class="card-action">
                    <span class="card-title blue-text text-darken-2">Productos Año</span>
                </div>
            </div>
        </div>
    </div>



@endsection