<nav class="light-blue lighten-1" role="navigation">
    <div class="container">
        <a id="logo-container" href="#" class="brand-logo">Logo</a>
    </div>
    <div class="nav-wrapper ">
        <ul class="right">
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