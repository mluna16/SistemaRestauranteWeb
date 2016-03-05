<div class="row">
    <div class="input-field col s12  l6">
        {!! Form::text('name', null,['class' => 'validate nameProduct'])!!}
        {!! Form::label('name', 'Nombre del Producto ',['for' => 'name'])!!}
    </div>
    <div class="input-field col s12 l3">
        {!! Form::text('cost', null,['class' => 'validate costProduct '])!!}
        {!! Form::label('cost', 'Costo ',['for' => 'cost'])!!}
    </div>
    <div class="input-field col s12 l3">
        {!! Form::text('limit', null,['class' => 'validate limitProduct'])!!}
        {!! Form::label('limit', 'Limite diario ',['for' => 'limit'])!!}
    </div>
</div>
<div class="row">
    <div class="input-field col s12">
        {!! Form::textarea('description', null, ['class' => 'materialize-textarea descriptionProduct']) !!}
        {!! Form::label('description', 'Descripcion ',['for' => 'description'])!!}

    </div>
    <input type="reset" id='resetmenu' style="display: none !important;">
</div>
