@extends('layout.init')

@section('title')
    Inicio
@stop

@section('content')

    @include('partials.principal.headerPrincipal')

    <div class="container">
        <div class="row">

            @include('partials.errors')
            <h3>Crear Cuenta</h3>
            {!!Form::open([
                'route' => 'users.store',
                'method' => 'POST'])
            !!}

                @include('partials.admin.FormUser')

                <div class="row">
                    <div class="input-field col s6">
                        {!! Form::password('password',['class' => 'validate'])!!}
                        {!! Form::label('password', 'Contraseña ',['for' => 'password'])!!}
                    </div>
                    <div class="input-field col s6">
                        {!! Form::password('password_',['class' => 'validate'])!!}
                        {!! Form::label('password_', 'Repetir Contraseña ',['for' => 'password_'])!!}
                    </div>
                </div>

            <div class="row">
                    <div class="col s10 offset-s10 grid-example">
                        <button class="btn waves-effect waves-light " type="submit">Crear!
                            <i class="mdi-content-send right"></i>
                        </button>
                    </div>
                </div>
            {!!Form::close()!!}

        </div>
    </div>