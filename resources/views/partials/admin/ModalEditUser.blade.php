<div id="EditUserModal" class="modal">
    <div class="modal-content">
        <h4><span class="EditHeaderName">fdffd</span></h4>

        {!!Form::open([
        'route' => [
                'users.update',
                ':USER_ID'
                ],
        'method' => 'PUT',
        'id' => 'editUserForm',
        ])
        !!}
        @include('partials.admin.FormUser')
        <div class="row">
            <div class="col s12">
                <label>Tipo de Usuario</label>
                <select class="browser-default typeUser" name="type">
                    <option value="" disabled selected>Seleccione</option>
                    <option value="caja">Caja</option>
                    <option value="cocina">Cocina</option>
                    <option value="mesonero">Mesonero</option>
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <a href="#" id="editUserSubmit" type="submit" class="waves-effect waves-green btn-flat editUserSubmit  ">Editar</a>
        </div>
        {!!Form::close()!!}

    </div>




</div>