@extends('layout.dashboard')
@section('title') Estadisticas @endsection
@section('Menu') active @endsection
@section('infoPanel')
    <div class="row">
        @foreach($products as $menu)
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" style="width: 360px: height: 260px" src="{{asset('images/product/'.$menu['id_product'].'/'.$menu['image'])}}">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">{{$menu['name']}} <i class="mdi-navigation-more-vert right"></i></span>
                        <p data-id="{{$menu['id_product']}}"><a href="#">Editar</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{{$menu['name']}} <i class="mdi-navigation-close right"></i></span>
                        <span class="card-title grey-text text-darken-4">Precio : Bs {{$menu['cost']}} </span>
                        <span class="card-title grey-text text-darken-4">Limite Diario : {{$menu['limit']}} </span>

                        <p>{{$menu['description']}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection