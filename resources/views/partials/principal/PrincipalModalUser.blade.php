<div id="LoginInformation" class="modal ">
    <div class="modal-content">
        <div class="row">
            <div class="col s2 m4 l4 vertical-divider">
                <img src="images/yuna.jpg" alt="" class="circle responsive-img">
            </div>
            <div class="col s10 m8 l8">
                <div class="row">
                    <div class="col s12">
                    <h5> {{Auth::user()->FullName}} </h5>
                    <h6> Local : {{Auth::user()->LocalName}} </h6>
                    <h6> Cargo : {{Auth::user()->type}} </h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col s6 ">
                        <a class="waves-effect waves-light btn">Editar</a>
                    </div>
                    <div class="col s6 ">
                        <a class="waves-effect waves-light btn" href="{{ url('/auth/logout') }}">Cerrar Sesion</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>