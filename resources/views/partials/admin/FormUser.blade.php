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