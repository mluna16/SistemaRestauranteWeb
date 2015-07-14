@extends('layout.dashboard')
@section('title') Estadisticas @endsection
@section('Estadisticas') active @endsection

@section('infoPanel')
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header" id="eVenta">Estadisticas de Ventas</div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card hoverable">
                            <div class="card-image">
                                <div id="ventasDia"></div>                </div>
                            <div class="card-action">
                                <span class="card-title blue-text text-darken-2">Ventas del dia</span>

                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card">
                            <div class="card-image">
                                <div id="ventaSemana"></div>                </div>
                            <div class="card-action">
                                <span class="card-title blue-text text-darken-2">Ventas en losultimos 7 dias</span>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m12">
                        <div class="card">
                            <div class="card-image">
                                <div id="ventaAno"></div>                </div>
                            <div class="card-action">
                                <span class="card-title blue-text text-darken-2">Ventas en los ultimos 12 Meses</span>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li>
            <div class="collapsible-header" id="eProducto">Estadisticas de Productos</div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card hoverable">
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

            </div>
        </li>
        <li>
            <div class="collapsible-header" id="eMesonero">Estadisticas de Mesonero</div>
            <div class="collapsible-body">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <div class="card hoverable">
                            <div class="card-image">
                                <div id="mesonerosDia"></div>                </div>
                            <div class="card-action">
                                <span class="card-title blue-text text-darken-2">Mesonero con mas ventas al dia</span>

                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l6">
                        <div class="card">
                            <div class="card-image">
                                <div id="mesonerosSemana"></div>                </div>
                            <div class="card-action">
                                <span class="card-title blue-text text-darken-2">Mesonero con mas ventas a la Mes</span>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </li>
    </ul>






@endsection