<nav class="light-blue lighten-1 fixed" role="navigation">
    <div class="container">
        <a id="logo-container" href="#" class="brand-logo">Logo</a>
    </div>
    <div class="nav-wrapper ">
        <ul class="right">
            @if(Auth::check()== true)
                <a class='dropdown-button' href='#' data-beloworigin="true" data-activates='dropdownProfile'>{{Auth::user()->FullName}} <i class="mdi-navigation-arrow-drop-down right"></i></a>

                <!-- Dropdown Structure -->
                <ul id='dropdownProfile' class='dropdown-content'>
                    <li><a href="">Configuracion</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/auth/logout') }}">Cerrer Sesion</a></li>
                </ul>
            @else
                <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
                <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            @endif
        </ul>

        <ul id="nav-mobile" class="side-nav">
            @if(Auth::check()== true)
                <li><a href="#">{{Auth::user()->FullName}}</a></li>
                <li><a href="{{ url('/auth/logout') }}">Cerrer Sesion</a></li>

            @else
                <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
                <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            @endif

        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </div>
</nav>