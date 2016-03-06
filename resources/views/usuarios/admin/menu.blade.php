@extends('layout.dashboard')
@section('title') Menu @endsection
@section('Menu') active @endsection
@section('numeroBotonFlotante') 5 @endsection
@section('TextoTour') El módulo de Menú, permite listar el menú de los productos ofrecidos por el restaurante @endsection

<div id="MenuPrincipal">
@section('infoPanel')
    <div class="row" id="MenuPrincipal" data-step="2" data-intro="Lista de todos los productos con información detallada de cada uno" data-position='left'>
        @if($products != null)
            @foreach($products as $i => $menu)
                <div class="col s12 m6 l4">
                    @if($i == 0)
                    <div class="card" id="CardMenu{{$menu['id_product']}}" data-step="3" data-intro="Información detalla del producto {{$menu['name']}}" data-position='left'>
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" style="width: 360px height: 260px" src="{{asset($menu['image'])}}">
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12">
                                    <span class="card-title activator grey-text text-darken-4">{{$menu['name']}} <i data-step="4" data-intro="Botón que muestra información más detallada." data-position='left' class="mdi-navigation-more-vert right"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-reveal" >
                            <span class="card-title grey-text text-darken-4">{{$menu['name']}} <i class="mdi-navigation-close right"></i></span>
                            <span class="card-title grey-text text-darken-4">Precio : Bs {{$menu['cost']}} </span>
                            <span class="card-title grey-text text-darken-4">Limite Diario : {{$menu['limit']}} </span>
                            <p>{{$menu['description']}}</p>
                            <div class="row">
                                <a   href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 EditProduct" data-position="top" data-delay="50" data-tooltip="Editar" data-id="{{$menu['id_product']}}"><i class="tiny mdi-editor-mode-edit "></i></a>

                                @if($menu['status'] == true)
                                    <a  href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                @else
                                    <a  href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                @endif

                                <a  href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct red darken-1" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Eliminar"><i class="mdi-action-delete "></i></a>

                            </div>
                        </div>
                    </div>
                    @else
                        <div class="card" id="CardMenu{{$menu['id_product']}}">
                            <div class="card-image waves-effect waves-block waves-light">
                                <img class="activator" style="width: 360px height: 260px" src="{{asset($menu['image'])}}">
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12">
                                        <span class="card-title activator grey-text text-darken-4">{{$menu['name']}} <i  class="mdi-navigation-more-vert right"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-reveal">
                                <span class="card-title grey-text text-darken-4">{{$menu['name']}} <i class="mdi-navigation-close right"></i></span>
                                <span class="card-title grey-text text-darken-4">Precio : Bs {{$menu['cost']}} </span>
                                <span class="card-title grey-text text-darken-4">Limite Diario : {{$menu['limit']}} </span>
                                <p>{{$menu['description']}}</p>
                                <div class="row">
                                    <a data-step="5" data-intro="Para editar la informacion del producto" data-position='top' href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 EditProduct" data-position="top" data-delay="50" data-tooltip="Editar" data-id="{{$menu['id_product']}}"><i class="tiny mdi-editor-mode-edit "></i></a>
                                    @if($menu['status'] == true)
                                        <a   href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                    @else
                                        <a  href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                    @endif
                                    <a  href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteProduct red darken-1" data-position="top" data-delay="50" data-id="{{$menu['id_product']}}" data-name="{{$menu['name']}}" data-tooltip="Eliminar"><i class="mdi-action-delete "></i></a>

                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            @else
        <h4 > no hay productos disponibles</h4>
        @endif
    </div>
    @include('partials.admin.ModalSoftDeleteProduct')
    @include('partials.admin.ModalEditMenu')

    @endsection
</div>