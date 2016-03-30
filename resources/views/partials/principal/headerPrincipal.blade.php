<nav class="light-blue lighten-1 fixed" role="navigation">
    <div class="container">
    </div>
    <div class="nav-wrapper ">
        <ul class="right">
            @if(Auth::check()== true)
                <li>
                    <a class="waves-effect waves-light btn tourActive"  onclick="introJs().start();">Tour</a>

                </li>
               <li>
                   <a class='dropdown-button modal-trigger' href="#LoginInformation">
                        {{Auth::user()->FullName}}
                         <i class="small mdi-social-person right"></i>

                </a>
               </li>
            @else
                <li><a href="{{url('auth/register')}}">Crear cuenta</a></li>
                <li><a href="{{url('auth/login')}}">Iniciar sesión</a></li>
            @endif

        </ul>
    </div>
</nav>
@if(Auth::check()== true)
    @include('partials.principal.PrincipalModalUser')
@endif