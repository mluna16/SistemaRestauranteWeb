@extends('usuarios.caja.infoPedido')

@section('InfoPedido')
    @if(isset($data['data']['CostTable']))
        <div id="infoPedido">
            <div class="col s12 m12 l6">
                <div class="row">
                    <div class="col s12 m12 l12">
                        <div class="card large">
                            <div class="card-content " >
                                <h4>Mesa Numero {{$data['data']['NumberTable']}}</h4>
                                <table class="table-responsive">
                                    <thead>
                                    <tr>
                                        <th data-field="producto">Producto</th>
                                        <th data-field="precio">Precio</th>
                                        <th data-field="estado">Estado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data['data']['Pedidos'] as $pedidos)
                                        <tr data-id="{{$pedidos['ProductId']}}">
                                            <td> {{$pedidos['ProductName']}}</td>
                                            <td> {{$pedidos['ProductCost']}}</td>
                                            <td> {{$pedidos['OrderState']}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                            </div>
                            <div class="card-action light-green lighten-1">
                                <div class="row">
                                    <div class="col s8 m8 l8">
                                        <h5 class="left-align">Total Bs : {{$data['data']['CostTable']}}} </h5>
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
    @else
        <div class="col s12 m12 l6">
            <div class="row">
                <div class="col s12 m12 l12">
                    <div class="card large">
                        <div class="card-content " >

                            <p class="">
                                Seleccione una mesa ocupada
                            </p>
                        </div>
                        <div class="card-action light-green lighten-1">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection