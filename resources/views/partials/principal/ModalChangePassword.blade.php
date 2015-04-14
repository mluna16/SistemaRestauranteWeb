<div id="changePassword" class="modal modal-fixed-footer" xmlns="http://www.w3.org/1999/html">
    <div class="modal-content">
        <div id="changePasswordPaso0" class="changePasswordPaso0">
            <div class="valign-demo valign-wrapper">
                <h5 class="valign center" style="width: 100%;">Bienvenido!</h5></br></br>
                <h6 class="valign center" style="width: 100%;">Primero debes cambiar tu contraseña!</h6>


            </div>
        </div>
        <div id="changePasswordPaso1" class="changePasswordPaso1" style="display: none">
            <p>Cambiar contraseña</p>

            {!!Form::open([
            'route' => 'userChangePassword',
            'method' => 'POST',
            'id' => 'changePasswordForm',
            ])
            !!}
            <div class="row">
                <div class="input-field col s12">
                    {!! Form::password('password',['class' => 'validate'])!!}
                    {!! Form::label('password', 'Contraseña ',['for' => 'password'])!!}
                </div>

            </div>
            <div class="row">
                <div class="input-field col s12">
                    {!! Form::password('password_',['class' => 'validate'])!!}
                    {!! Form::label('password', 'Repida la Contraseña ',['for' => 'password'])!!}

                </div>
            </div>
            {!!Form::close()!!}

        </div>


    </div>
    <div class="modal-footer">
        <!-- <div class="container">
            <div class="progress">
                <div class="determinate" style="width: 0%"></div>
            </div>
        </div> -->
        <a href="#"  class="waves-effect waves-green btn-flat modal-action  changePasswordPaso0 ">Siguiente</a>
        <a href="#"  style="display:none"class="waves-effect waves-green btn-flat modal-action changePasswordSubmit ">Cambiar</a>


    </div>
</div>