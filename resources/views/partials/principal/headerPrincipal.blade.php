<nav class="light-blue lighten-1" role="navigation">
    <div class="container">
        <a id="logo-container" href="#" class="brand-logo">Logo</a>
    </div>
    <div class="nav-wrapper ">
        <ul class="right">
            @if(isset($user))
                <a class='dropdown-button' href='#' data-activates='dropdownProfile'>{{$user[0]->FullName}}</a>

                <!-- Dropdown Structure -->
                <ul id='dropdownProfile' class='dropdown-content'>
                    <li><a href="">Edit</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ url('/auth/logout') }}">Cerrer Sesion</a></li>
                </ul>
            @else
            <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
            <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            @endif
        </ul>

        <ul id="nav-mobile" class="side-nav">
            @if(isset($user))
                <li><a href="#">{{$user[0]->FullName}}</a></li>
                <li><a href="{{ url('/auth/logout') }}">Cerrer Sesion</a></li>

            @else
                <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
                <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            @endif

        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </div>
</nav>