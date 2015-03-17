@extends('layout_init')

    @section('title')
             Inicio
    @stop

    @section('content')

       @include('partials.principal.headerPrincipal')

        <div class="section no-pad-bot" id="index-banner">
            <div class="container">
                <h2>Sistema Restaurante Web</h2>
               <p class="flow-text">
                   La propuesta que se plantea es el desarrollar una aplicación móvil que

                   tenga dos (2) ambientes, uno para el mesonero que hace los pedidos y uno para la cocina

                   que se encarga de la preparación de los pedidos, de este modo logrando una comunicación

                   rápida entre ambos, facilitando al mesonero saber cuándo un pedido está listo; además la

                   realización de un módulo web para llevar todos los procesos relacionados a la cobranza, en

                   el cual se utilizan los datos enviados desde el módulo móvil y es mostrado en pantalla una

                   lista de servicios prestados junto con el monto total de los pedidos realizados por esa mesa

                   al mesonero; el encargado de la cobranza solo deberá pulsar el botón Facturar y el sistema

                   se encargará de imprimir la factura que posteriormente será entregada al cliente del

                   restaurante, de este modo manteniendo el control de los pagos por los servicios y control de

                   los consumos en general por parte de las personas encargadas del restaurante.
               </p>

            </div>
        </div>

        <div class="container">

        </div>

        <footer class="page-footer orange">
            <div class="container">
                <div class="row">
                    <div class="col l6 s12">
                        <h5 class="white-text">Company Bio</h5>
                        <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>


                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Settings</h5>
                        <ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>
                    </div>
                    <div class="col l3 s12">
                        <h5 class="white-text">Connect</h5>
                        <ul>
                            <li><a class="white-text" href="#!">Link 1</a></li>
                            <li><a class="white-text" href="#!">Link 2</a></li>
                            <li><a class="white-text" href="#!">Link 3</a></li>
                            <li><a class="white-text" href="#!">Link 4</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright">
                <div class="container">
                    Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
                </div>
            </div>
        </footer>
    @endsection
