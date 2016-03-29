<div class="row">
    <div class="input-field col s12  l8">
        {!! Form::text('name', null,['class' => 'validate localName'])!!}
        {!! Form::label('name', 'Nombre del Local ',['for' => 'name'])!!}
    </div>
    <div class="input-field col s12 l4">
        {!! Form::text('number_tables', null,['class' => 'validate localNumberTables'])!!}
        {!! Form::label('number_tables', 'Numero de Mesas ',['for' => 'number_tables'])!!}
    </div>

</div>
<div class="row">
    <div class="input-field col s6">
        {!! Form::text('rif', null,['class' => 'validate localRif'])!!}
        {!! Form::label('rif', 'RIF',['for' => 'rif'])!!}
    </div>
    <div class="input-field col s6">
        {!! Form::text('location', null,['class' => 'validate localLocation'])!!}
        {!! Form::label('location', 'Ubicacion',['for' => 'location'])!!}
    </div>
</div>
{!! Form::hidden('owner', \Hash::make(Auth::user()->id)) !!}