@extends('layout.layout_init')

@section('title')
    Inicio de Sesion
@stop

@section('content')

    @include('partials.principal.headerPrincipal')

    <div class="container">
        <div class="row">
            @include('partials.errors')
            <h3>Iniciar Sesion</h3>
            {!!Form::open([
            'url' => '/auth/login',
            'method' => 'POST'])
            !!}
                <div class="card medium">
                    <div class="container">
                        <div class="row">
                            <div class="input-field col s12">
                                {!! Form::email('email', null,['class' => 'validate'])!!}
                                {!! Form::label('email', 'Correo Electronico ',['for' => 'email'])!!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                {!! Form::password('password', ['class' => 'validate'])!!}
                                {!! Form::label('password', 'Clave ',['for' => 'password'])!!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col  s12 ">
                                {!! Form::checkbox('remember','false')!!}
                                {!! Form::label('remember', 'Recuerdame ',['for' => 'remember'])!!}

                            </div>
                        </div>

                        <div class="card-action">
                            <div class="row">
                                <div class="container">
                                    <div class="input-field col l6 s12 m6">
                                        <div>
                                            <a href="#/password/email">Forgot Your Password?</a>
                                        </div>
                                    </div>
                                    <div class="input-field col l6 s12 m4">
                                        <button class="btn waves-effect waves-light " type="submit">Iniciar Sesion!
                                            <i class="mdi-content-send right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            {!!Form::close()!!}
		</div>
    </div>
@endsection
