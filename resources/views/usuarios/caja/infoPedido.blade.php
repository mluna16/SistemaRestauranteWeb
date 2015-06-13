@extends('usuarios.caja.caja')
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
    </div>
@stop