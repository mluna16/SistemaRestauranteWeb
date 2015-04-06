<div id="create_menu" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4> Crear nuevo producto para el menu </h4>
        <div id="menuPaso1">
            {!!Form::open([
            'route' => 'admin.producto.store',
            'method' => 'POST',
            'id' => 'crear_menuForm',
            ])
            !!}
            <div class="row">
                <div class="input-field col s12  l6">
                    {!! Form::text('name', null,['class' => 'validate'])!!}
                    {!! Form::label('name', 'Nombre del Producto ',['for' => 'name'])!!}
                </div>
                <div class="input-field col s12 l3">
                    {!! Form::text('cost', null,['class' => 'validate'])!!}
                    {!! Form::label('cost', 'Costo ',['for' => 'cost'])!!}
                </div>
                <div class="input-field col s12 l3">
                    {!! Form::email('limit', null)!!}
                    {!! Form::label('limit', 'Limite diario ',['for' => 'limit'])!!}
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    {!! Form::textarea('description', null, ['class' => 'materialize-textarea']) !!}
                    {!! Form::label('description', 'Descripcion ',['for' => 'description'])!!}

                </div>
            </div>

            {!! Form::hidden('created_by', Auth::user()->id) !!}
            {!! Form::hidden('local_for', 1) !!}
            {!!Form::close()!!}
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" id="crear_menuSubmit" class="waves-effect waves-green btn-flat modal-action modal-close">Siguiente</a>
    </div>
</div>