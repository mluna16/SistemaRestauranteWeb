<div id="create_local" class="modal modal-fixed-footer" xmlns="http://www.w3.org/1999/html">
    <div class="modal-content">
        <div id="localPaso0" class="localPaso0">
            <div class="valign-demo valign-wrapper">
                <h5 class="valign center" style="width: 100%;">Bienvenido!</h5></br></br>
                <h6 class="valign center" style="width: 100%;">Primero debes cargar los datos de tu Local!</h6>


            </div>
        </div>
        <div id="localPaso1" class="localPaso1" style="display: none">
            <p>Cargar datos del local</p>

            {!!Form::open([
            'route' => 'admin.local.store',
            'method' => 'POST',
            'id' => 'crear_localForm',
            ])
            !!}
                @include('partials.admin.FormLocal')
            {!!Form::close()!!}

        </div>
        <div style="display:none" class="localPaso2">
            <p>Cargar Imagenes del Local</p>
            {!!Form::open([
            'route' => [
            'localImagenUpload'

            ],
            'file' => true,
            'class' => 'dropzone',
            'id' => 'crearLocalFormImages',
            'method' => 'POST',
            ])
            !!}
            <h6 class="dz-message"><i class="medium mdi-editor-attach-file"></i>Arrastra hasta o has click aqui para agregar la imagen al Local (Maximo 1)</h6>
            {!!Form::close()!!}
        </div>

    </div>
    <div class="modal-footer">
        <!-- <div class="container">
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
        </div> -->
        <a href="#"  class="waves-effect waves-green btn-flat modal-action localPaso0 crear_localPaso0 ">Siguiente</a>
        <a href="#"  style="display:none"class="waves-effect waves-green btn-flat modal-action crear_localSubmit ">Siguiente</a>
        <a href="#"  style="display:none"class="waves-effect waves-green btn-flat modal-action  crear_localSubmitnone ">Siguiente</a>
        <a href="#"  style="display:none" class="waves-effect waves-green btn-flat modal-action  localPaso2 localPaso2Atras">Atras</a>


    </div>
</div>