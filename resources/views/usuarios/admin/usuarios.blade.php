@extends('layout.dashboard')
@section('title') Usuarios @endsection
@section('Usuarios') active @endsection
@section('numeroBotonFlotante') 7 @endsection
@section('TextoTour') El módulo de Usuario, permite visualizar los usuarios ordenados por la función que cumplen en el restaurante @endsection

@section('infoPanel')

    <ul class="collapsible"  data-collapsible="expandable">

        <li data-step="2" data-intro="Usuarios de caja: son los encargados de las funciones de caja y facturación" data-position='left'>
            <div class="collapsible-header "id="userCaja">Caja</div>
            <div class="collapsible-body">
                <table class="striped centered responsive-table">
                    @include('partials.admin.UserTable')
                    <tbody>
                    @foreach($users as  $caja)
                        @if($caja['type'] == 'caja')

                            <tr data-id="{{$caja-> id}}" data-fullname="{{$caja->full_name}}">
                                <td><img class="responsive-img circle"  style="width: 50px;height: 50px;" src="{{$caja -> img_profile}}"></td>
                                <td>{{$caja->full_name}}</td>
                                <td>{{$caja->email}}</td>
                                <td>
                                    @if($users['primero']==true)
                                        {{$users['primero'] = false}}

                                        <div class="row">
                                            <a data-step="3" data-intro="Permite editar la información de un usuario"  data-position='top'href="#" class="btn tooltipped col s2 offset-s4  EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                            @if($caja->status == true)
                                                <a data-step="4" data-intro="Permite desactivar o activar un usuario" data-position='top' href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                            @else
                                                <a data-step="4" data-intro="Permite desactivar o activar un usuario" data-position='top'href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                            @endif
                                        </div>
                                    @else
                                    <div class="row center-align">
                                        <a href="#" class="btn tooltipped col s2 offset-s4  EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                        @if($caja->status == true)
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                        @else
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                        @endif
                                    </div>
                                    @endif

                                </td>
                            </tr>
                        @endif

                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>
        <li data-step="5" data-intro="Usuarios cocineros: los cocineros se encargan de preparar los platos e indican cuando un plato está listo" data-position='left'>
            <div class="collapsible-header">Cocina</div>
            <div class="collapsible-body">
                <table class="striped centered responsive-table">
                    @include('partials.admin.UserTable')
                    <tbody>
                    @foreach($users as $cocina)
                        @if($cocina['type'] == 'cocina')
                            <tr data-id="{{$cocina -> id}}" data-fullname="{{$cocina->full_name}}">
                                <td><img class="responsive-img circle"  style="width: 50px;height: 50px;" src="{{$cocina -> img_profile}}"></td>
                                <td>{{$cocina->full_name}}</td>
                                <td>{{$cocina->email}}</td>
                                <td>
                                    <div class="row">
                                        <a href="#" class="btn tooltipped col s2 offset-s4 EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                        @if($cocina->status == true)
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                        @else
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>

        <li data-step="6" data-intro="Usuarios mesoneros: su función principal es atender a los clientes y enviar los pedidos a la cocina" data-position='left'>
            <div class="collapsible-header"></i>Mesonero</div>
            <div class="collapsible-body">
                <table class="striped centered responsive-table">
                    @include('partials.admin.UserTable')
                    <tbody>
                    @foreach($users as $mesonero)
                        @if($mesonero['type'] == 'mesonero')
                            <tr data-id="{{$mesonero -> id}}" data-fullname="{{$mesonero->full_name}}">
                                <td><img class="responsive-img circle"  style="width: 50px;height: 50px;" src="{{$mesonero -> img_profile}}"></td>
                                <td>{{$mesonero->full_name}}</td>
                                <td>{{$mesonero->email}}</td>
                                <td>
                                    <div class="row">
                                        <a href="#" class="btn tooltipped col s2 offset-s4  EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                        @if($mesonero->status == true)
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                        @else
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>
    </ul>
    @include('partials.admin.ModalSoftDeleteUser')
    @include('partials.admin.ModalEditUser')
    <script>
        $('.collapsible').collapsible();
    </script>
@endsection
