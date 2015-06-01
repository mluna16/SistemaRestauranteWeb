@extends('layout.init')
@section('title') Caja @endsection
@endsection
@section('content')
    @include('partials.principal.headerPrincipal')
    <div class="row">
        @section('tablesPanel')
            <div class="col s12 m12 l6">
                <div class="row">
                    @for($i=1; $i <= $data['TotalMesas'];$i++)
                        @if($data['Mesas'][$i-1]['State'] == 'ocupado')
                            <div class="col s6 m4 l3" style="cursor: pointer">
                                <a class="mostrar_mesa tooltipped" data-id="{{$i}}" data-position="right" data-delay="50" data-tooltip="{{$data['Mesas'][$i-1]['State']}}">
                                    <div class="card-panel red lighten-3 ">
                                        <h5 class="black-text center-align ">{{$i}} </h5>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col s6 m4 l3">
                                <a class="tooltipped" data-position="right" data-delay="50" data-tooltip="{{$data['Mesas'][$i-1]['State']}}">
                                    <div class="card-panel green lighten-3 ">
                                        <h5 class="black-text center-align ">{{$i}} </h5>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @endfor
                </div>
                @show

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
                <div id="infoPedido">

                </div>

            </div>
    </div>
@endsection
@section('alternalJS')

    <script src="{{asset('js/functionsUser.js')}}"></script>


    <script>
        $(document).ready(function() {
            $('.mostrar_mesa').click(function (e) {
                var id =$(this).attr('data-id')
                $(this).ajaxGetData('caja/infoOrden/'+id, 'infopedido', 'data')

            })

        })
    </script>
@endsection