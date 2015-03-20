<nav class="light-blue lighten-1" role="navigation">
    <div class="container">
        <a id="logo-container" href="#" class="brand-logo">Logo</a>
    </div>
    <div class="nav-wrapper ">
        <ul class="right">
            @if (Session::has('user'))
                $user = session('key');

                <li>{{$user}}</li>
            @else
            <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
            <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            @endif
        </ul>

        <ul id="nav-mobile" class="side-nav">
            @if (Session::has('user'))
                $user = session('key');
                <li>{{$user}}</li>
            @else
                <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
                <li><a href="{{url('auth/login')}}">Iniciar sesion</a></li>
            @endif

        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
    </div>
</nav>