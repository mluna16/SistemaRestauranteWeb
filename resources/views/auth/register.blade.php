@extends('layout_init')

@section('title')
    Inicio
@stop

@section('content')

    @include('partials.principal.headerPrincipal')

    <div class="container">
        <div class="row">

            @if($errors->any())
                <div class="row">
                    <div class="col s12 m12">
                        <div class="card-panel red darken-1">
                            <h5 class="white-text">Corrige los siguientes errores</h5>
                                  @foreach($errors->all() as $error)
                                <p class="white-text">{{$error}}</p>
                                  @endforeach

                        </div>
                    </div>
                </div>


            @endif()
            {!!Form::open([
                'route' => 'users.store',
                'method' => 'POST'])
            !!}
                <h3>Crear Cuenta</h3>
                <div class="row">
                    <div class="input-field col s6">
                        {!! Form::text('first_name', null,['class' => 'validate'])!!}
                        {!! Form::label('first_name', 'Nombre ',['for' => 'first_name'])!!}
                    </div>
                    <div class="input-field col s6">
                        {!! Form::text('last_name', null,['class' => 'validate'])!!}
                        {!! Form::label('last_name', 'Apellido ',['for' => 'last_name'])!!}
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        {!! Form::email('email', null,['class' => 'validate'])!!}
                        {!! Form::label('email', 'Correo Electronico',['for' => 'correo'])!!}
                    </div>
                </div>
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