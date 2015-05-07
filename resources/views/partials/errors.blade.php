@if($errors->any())
    <div class="row">
        <div class="col s12 m12">
            <div class="card-panel red darken-1">
                <h5 class="white-text">Corrige los siguientes errores</h5>
                @foreach($errors->all() as $error)
                    <p class="white-text">{{$error}}</p>
                @endforeach

            </div>
        </div>
    </div>
@endif()