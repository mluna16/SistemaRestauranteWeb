@extends('layout.dashboard')
@section('title') Estadisticas @endsection
@section('Menu') active @endsection
<div id="MenuPrincipal">
@section('infoPanel')
    <div class="row" id="MenuPrincipal" >
        @foreach($products as $menu)
            <div class="col s12 m6 l4">
                <div class="card" id="CardMenu{{$menu['id_product']}}">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" style="width: 360px height: 260px" src="{{asset('images/product/'.$menu['id_product'].'/'.$menu['image'])}}">
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <span class="card-title activator grey-text text-darken-4">{{$menu['name']}} <i class="mdi-navigation-more-vert right"></i></span>
                            </div>
                        </div>



                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">{{$menu['name']}} <i class="mdi-navigation-close right"></i></span>
                        <span class="card-title grey-text text-darken-4">Precio : Bs {{$menu['cost']}} </span>
                        <span class="card-title grey-text text-darken-4">Limite Diario : {{$menu['limit']}} </span>
                        <p>{{$menu['description']}}</p>
                        <div class="row">
                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 EditProduct" data-position="top" data-delay="50" data-tooltip="Editar" data-id="{{$menu['id_product']}}"><i class="tiny mdi-editor-mode-edit "></i></a>
                            @if($menu['status'] == true)
                                <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                            @else
                                <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                            @endif
                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct red darken-1" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Eliminar"><i class="mdi-action-delete "></i></a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @include('partials.admin.ModalSoftDeleteProduct')
    @include('partials.admin.ModalEditMenu')

    @endsection
</div>