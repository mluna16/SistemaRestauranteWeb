@extends('layout.init')
@section('title') Caja @endsection
@section('content')
    @include('partials.principal.headerPrincipal')
    <div class="row">
        <div id="infoTables"  >
                @section('tablesPanel')

                @show
        </div>
        <div class="col s12 m12 l6" data-step="2" data-intro="Muestra los pedidos de una mesa en especifico y da la posibilidad de facturar" data-position='left' >
                <div id="infoPedido">

                </div>

            </div>
    </div>
@endsection
@include('tours.caja')

@section('alternalJS')

    <script src="{{asset('js/functionsUser.js')}}"></script>


    <script>
        $(document).ready(function() {
            $(document).on('click','.mostrar_mesa',function(){
                var id =$(this).attr('data-id')
                $(this).ajaxGetData('caja/infoOrden/'+id, 'infopedido', 'data')
            })
            setInterval(function(){
                if ($('.mostar_mesa').hasClass('facturar')){
                }
                $.ajax({
                    type: 'GET',
                    url: 'caja',
                    dataType: 'json',
                    success: function (data) {
                       $('#infoTables').empty().append($(data)); //se toma la data en formato json, luego se borra el Div padre de el Sections y se pinta el json (data) como htlm
                    },
                    error: function (data) {
                        var errors = data.responseJSON;
                        if (errors) {
                            $.each(errors, function (i) {
                                console.log(errors[i]);
                            });
                        }
                    }
                });
            },5000);




        })
    </script>
    <div id="modalPrincipal">

    </div>
@endsection