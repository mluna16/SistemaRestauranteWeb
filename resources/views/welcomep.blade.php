@extends('layout.parallax')

@section('contentParallax')
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="#" class="brand-logo"></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
                <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            </ul>

            <ul id="nav-mobile" class="side-nav">
                <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
                <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            </ul>
            <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
        </div>
    </nav>

    <div id="index-banner" class="parallax-container">
        <div class="section no-pad-bot">
            <div class="container">
                <br><br>
                <h1 class="header center orange-text text-darken-4">No tenemos nombre aun</h1>
                <div class="row center">
                    <h5 class="header col s12 brown-text text-darken-3 light">Pero este sistema web y movíl para <span class="red-text text-darken-4">Restaurante</span> lo tendra! </h5>
                </div>

                <br><br>

            </div>
        </div>
        <div class="parallax" ><img  src="{{asset('images/restaurante3.jpg')}}" class="img1" alt="Unsplashed background img 2"></div>
    </div>


    <div class="container">
        <div class="section">

            <!--   Icon Section   -->
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center green-text  text-darken-4"><i class="mdi-action-face-unlock"></i></h2>
                        <h5 class="center">Desarrollado para Personas</h5>

                        <p class="light">El sistema esta efocado para que cualquier persona pueda usarla sin complejidad.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center green-text  text-darken-4"><i class="mdi-social-group"></i></h2>
                        <h5 class="center">Porqué dos son mejor que uno</h5>

                        <p class="light">Son dos sistemas en uno. Por un lado tienes el sistema web para gestinar el restaurante y manejar la caja. Y otro una aplicacion Android para manejar las Mesas, los pedidos y la cocina.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center green-text  text-darken-4"><i class="mdi-hardware-cast-connected"></i></h2>
                        <h5 class="center">Conecta tu Chromecast</h5>

                        <p class="light">Puedes tener toda la aplicacion Android enlazada en tu dispositivo Chromecast.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">

            <div class="row center">
                    <h4 class="header col s12 thin">Maneja las ordenes y los pedidos de tu <span class="light-green-text text-lighten-3">Restaurante</span> de forma ordenada y eficiente</h4>
                </div>

            </div>
        <div class="parallax"><img src="{{asset('images/restaurante2.jpg')}}" alt="Unsplashed background img 2"></div>
    </div>

    <div class="container">
        <div class="section">

            <div class="row">
                <div class="col s12 center">
                    <h3><i class="green-text  text-darken-4 mdi-hardware-keyboard-alt"></i></h3>
                    <h4>¿ Por qué somos útiles para tí ?</h4>
                    <p class="left-align light">El reemplazo de sistemas anticuados o desactualizados como el de pedidos en un restaurante por un sistema móvil que se encargue de la comunicación de los mesoneros con la cocina, contribuirá a que estos procesos sean más eficientes y atractivos, además que se unen a la idea de un mundo cada vez más evolucionado que aprovecha las nuevas tecnologías para hacer cómodos y funcionales hasta los procesos cotidianos. En este sentido, el propósito de la investigación es precisamente construir una aplicación informática que combine las prestaciones de las aplicaciones móviles con el uso de las web y dispositivos streaming. De esta manera, atender de mejor forma las solicitudes de servicio y despacho en un restaurante, tal como el caso de estudio</p>
                </div>
            </div>

        </div>
    </div>


    <div class="parallax-container valign-wrapper">
        <div class="section no-pad-bot">
                <div class="row center">
                    <h4 class="header col s12 thin">Nos adaptamos a su <span class="red-text text-darken-4">Restaurante</span>, no importa si tiene 2 mesas o <span class="red-text text-lighten-1">1.000</span></h4>
                </div>
        </div>
        <div class="parallax"><img src="{{asset('images/restaurante4.jpg')}}" alt="Unsplashed background img 3"></div>
    </div>

    <footer class="page-footer  green darken-1">
        <div class="container">
            <div class="row">
                <div class="col  s12">
                    <h5 class="white-text">No tenemos nombre aun !</h5>
                    <p class="grey-text text-lighten-4">Este Sistema está siendo desarrollado como proyecto tesis para la obtención de un título Universitario de Licenciado en Informática de la Universidad de Oriente Núcleo Nueva Esparta.</p>


                </div>

            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                Made for <a class="text-white" href="https://www.facebook.com/pedro.moyahernandez">Pedro Moya</a>
                & <a class="text-white" href="http://marcoslunah.herokuapp.com">Marcos Luna H</a>

            </div>
        </div>
    </footer>
@endsection