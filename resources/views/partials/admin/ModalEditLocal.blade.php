<div id="Editlocal" class="modal modal-fixed-footer" xmlns="http://www.w3.org/1999/html">
    <div class="modal-content">
        <h4>Editar Local</h4>

        <div id="localPaso1" class="localPaso1" >

            {!!Form::open([
            'route' => [
                'admin.local.update',
                ':LOCAL_ID'
            ],
            'method' => 'PUT',
            'id' => 'editLocalForm',
            ])
            !!}
            @include('partials.admin.FormLocal')
            {!!Form::close()!!}

        </div>


    </div>
    <div class="modal-footer">
        <!-- <div class="container">
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
        </div> -->
        <a href="#"  class="waves-effect waves-green btn-flat modal-action LocalEditSubmit ">Editar</a>


    </div>
</div>