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
    <div class="col s4">
        <label>Tipo de Producto</label>
        <select class="browser-default" name="type">
            <option value="" disabled selected>Seleccione</option>
            <option value="menu">Menú</option>
            <option value="extra">Extra</option>
        </select>
    </div>
    <div class="input-field col s8">
        {!! Form::textarea('description', null, ['class' => 'materialize-textarea descriptionProduct']) !!}
        {!! Form::label('description', 'Descripción ',['for' => 'description'])!!}

    </div>
    <input type="reset" id='resetmenu' style="display: none !important;">
</div>
