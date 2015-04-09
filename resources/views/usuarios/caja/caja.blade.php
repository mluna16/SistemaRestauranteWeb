@extends('layout.init')
@section('title') Caja @endsection

@endsection
@section('content')
    @include('partials.principal.headerPrincipal')
    <div class="row">
        <div class="col s12 m12 l6">
            @foreach($data['Local'] as $local)
                <div class="row">
                    @for($i=1; $i <= $local->mesas;$i++)
                    <div class="col s6 m4 l3">
                        <a class="mostrar_mesa">
                            <div class="card-panel teal ">

                                <h5 class="white-text center-align ">{{$i}} </h5>
                            </div>
                        </a>

                    </div>
                    @endfor
                </div>

            @endforeach
                {!!Form::open([
                     'route' => [
                     'caja.pedido.show',
                     ':MESA_ID'
                     ],
                     'method' => 'GET',
                     'id' => 'form_mostrar_mesa'])
                    !!}
                {!!Form::close()!!}
        </div>

        <div class="col s12 m12 l6">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card large">
                        <div class="card-content " id="info_mesa">

                            <p class="factura_pedidos">

                            </p>
                        </div>
                        <div class="card-action light-green lighten-1">
                            <div class="row">
                                <div class="col s8 m8 l8">
                                    <h5 class="left-align  factura_total"> </h5>
                                </div>
                                <div class="col s4 m4 l4">
                                    <a class="btn  yellow lighten-4">Facturar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('alternalJS')
<script>

    $(document).ready(function(){
        $('.mostrar_mesa').click(function(e){
            $(this).children().removeClass('teal');
            $(this).children().addClass('light-green lighten-1');
            $('.preloader-wrapper').fadeOut();
            $('#info_mesa , .factura_total').empty();
            e.preventDefault();
             var form = $('#form_mostrar_mesa');
             var mesa = $(this).children().children().text();
             var url = form.attr('action').replace(':MESA_ID', mesa);
            console.log(form.attr('action'))

            var data = form.serialize();
            $('#info_mesa').append("@include('partials.preloader')")
             $.get(url, data, function (result) {
                 $('.mostrar_mesa').children().addClass('teal');
                 $('.mostrar_mesa').children().removeClass('light-green lighten-2');
                 $('.preloader-wrapper').hide();
                 $('<span class="card-title blue-text factura_mesa">Mesa Numero: ' + result["mesa"] + '  </span>').appendTo('#info_mesa')
                 $('<span class="card-title white-text factura_mesa">Total : Bs ' + result["precio"] + '  </span>').appendTo('.factura_total')
                 $('@include("partials.caja.OrderTable")'+ '<tbody><tr><td>'+result["nombre"]+'</td><td>'+result["precio"]+'</td></tr></tbody></table>').appendTo('#info_mesa')
             })
        })

    })
</script>
@endsection