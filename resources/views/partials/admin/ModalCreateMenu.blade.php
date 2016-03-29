@section('modalMenu')
<div id="create_menu" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4> Crear nuevo producto para el menú </h4>

        <div id="menuPaso1" class="menuPaso1">
            <p>Crear datos del Producto</p>

            {!!Form::open([
            'route' => 'admin.producto.store',
            'method' => 'POST',
            'id' => 'crear_menuForm',
            ])
            !!}
            @include('partials.admin.FormMenu')
            {!!Form::close()!!}
        </div>
        <div style="display:none" class="menuPaso2">
            <p>Cargar Imagenes del Producto</p>
            {!!Form::open([
            'route' => [
            'imagenUpload',
            'MENU_ID'
            ],
            'file' => true,
            'class' => 'dropzone',
            'id' => 'crearMenuFormImages',
            'method' => 'POST',
            ])
            !!}
            <h6 class="dz-message"><i class="medium mdi-editor-attach-file"></i>Arrastra hasta o has click aqui para agregar images al producto (Maximo 5)</h6>
            {!!Form::close()!!}
        </div>

    </div>
    <div class="modal-footer">
        <!-- <div class="container">
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
        </div> -->
        <a href="#"  class="waves-effect waves-green btn-flat modal-action crear_menuSubmit ">Siguiente</a>
        <a href="#"  style="display:none"class="waves-effect waves-green btn-flat modal-action  crear_menuSubmitnone menuPaso1">Siguiente</a>
        <a href="#" id="menu2success" style="display:none"class="waves-effect waves-green btn-flat modal-action modal-close menuPaso2">Finalizar</a>
        <a href="#"  style="display:none" class="waves-effect waves-green btn-flat modal-action  menuPaso2 menuPaso2Atras">Atras</a>


    </div>
</div>
    <script>
        var imageDropZone = new Dropzone("#crearMenuFormImages", { url: "-"});
    </script>
    @endsection
