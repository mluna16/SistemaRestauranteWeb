<div id="create_menu" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4> Crear nuevo producto para el menu </h4>

        <div id="menuPaso1" class="menuPaso1">
            <p>Crear datos del Producto</p>

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
            {!! Form::hidden('created_by', \Hash::make(Auth::user()->id)) !!}
            {!! Form::hidden('local_for', \Hash::make(Auth::user()->id)) !!}


            {!!Form::close()!!}
        </div>
        <div style="display:none" class="menuPaso2">
            <p>Cargar Imagenes del Producto</p>
            {!!Form::open([
            'route' => [
                'productImage.zUploadImage',
                ':MENU_ID'
                ],
            'method' => 'POST',
            'id' => 'crear_menuFormImages',
            'file' => true,
            'class' => 'dropzone',
            ])
            !!}
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
            {!!Form::close()!!}
        </div>

    </div>
    <div class="modal-footer">
        <div class="container">
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
        </div>
        <a href="#"  class="waves-effect waves-green btn-flat modal-action crear_menuSubmit ">Siguiente</a>
        <a href="#"  style="display:none"class="waves-effect waves-green btn-flat modal-action  crear_menuSubmitnone menuPaso1">Siguiente</a>
        <a href="#"  style="display:none"class="waves-effect waves-green btn-flat modal-action  menuPaso2">Finalizar</a>
        <a href="#"  style="display:none" class="waves-effect waves-green btn-flat modal-action  menuPaso2 menuPaso2Atras">Atras</a>


    </div>
</div>