<div id="create_user" class="modal ">
    <div class="modal-content">
        <h4>Crear nuevo usuario </h4>

        {!!Form::open([
        'route' => 'userStoreAjax',
        'method' => 'POST',
        'id' => 'crear_userForm',
        ])
        !!}
        @include('partials.admin.FormUser')
        <div class="row">
            <div class="col s12">
                <label>Tipo de Usuario</label>
                <select class="browser-default" name="type">
                    <option value="" disabled selected>Seleccione</option>
                    <option value="caja">Caja</option>
                    <option value="cocina">Cocina</option>
                    <option value="mesonero">Mesonero</option>
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <a href="#" id="crear_userSubmit" type="submit" class="waves-effect waves-green btn-flat ">Crear</a>


        </div>
        {!! Form::hidden('password_', '12345',['class' => 'hidden']) !!}
        {!! Form::hidden('password', '12345',['class' => 'hidden']) !!}
        {!!Form::close()!!}
    </div>




</div>