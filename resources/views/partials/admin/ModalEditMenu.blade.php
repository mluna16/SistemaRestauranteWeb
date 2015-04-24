<div id="editMenu" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h4> Editar producto  </h4>

        <div >
            <p>Crear datos del Producto</p>

            {!!Form::open([
            'route' => [
                'admin.producto.update',
                ':PRODUCT_ID'
            ],
            'method' => 'PUT',
            'id' => 'EditmenuForm',
            ])
            !!}
                @include('partials.admin.FormMenu')
            {!!Form::close()!!}
        </div>
    </div>
    <div class="modal-footer">
        <!-- <div class="container">
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
        </div> -->
        <a href="#" class="waves-effect waves-green btn-flat modal-action editProductSubmit">Editar</a>


    </div>
</div>
