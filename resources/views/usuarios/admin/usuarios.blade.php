@extends('layout.dashboard')
@section('title') Usuarios @endsection
@section('Usuarios') active @endsection
@section('infoPanel')
    <ul class="collapsible"  data-collapsible="expandable">
        <li>
            <div class="collapsible-header ">Administradores</div>
            <div class="collapsible-body">
                <table class="striped centered responsive-table">
                    @include('partials.admin.UserTable')
                    <tbody>
                        @foreach($users as $admin)
                            @if($admin->type == 'admin')
                               <tr data-id="{{$admin -> id}}" data-fullname="{{$admin->full_name}}">
                                   <td><img class="responsive-img circle"  style="width: 50px;height: 50px;" src="{{$admin -> img_profile}}"></td>
                                    <td >{{$admin->full_name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                        @if($admin->status == true)
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 " data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                        @else
                                            <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 " data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                        @endif
                                    </td>
                               </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </li>
        <li>
            <div class="collapsible-header ">Caja</div>
            <div class="collapsible-body">
                <table class="striped centered responsive-table">
                    @include('partials.admin.UserTable')
                    <tbody>
                    @foreach($users as $caja)
                        @if($caja->type == 'caja')
                            <tr data-id="{{$caja -> id}}" data-fullname="{{$caja->full_name}}">
                                <td><img class="responsive-img circle"  style="width: 50px;height: 50px;" src="{{$caja -> img_profile}}"></td>
                                <td>{{$caja->full_name}}</td>
                                <td>{{$caja->email}}</td>
                                <td>
                                    <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                    @if($caja->status == true)
                                        <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                    @else
                                        <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>
        <li>
            <div class="collapsible-header">Cocina</div>
            <div class="collapsible-body">
                <table class="striped centered responsive-table">
                    @include('partials.admin.UserTable')
                    <tbody>
                    @foreach($users as $cocina)
                        @if($cocina->type == 'cocina')
                            <tr data-id="{{$cocina -> id}}" data-fullname="{{$cocina->full_name}}">
                                <td><img class="responsive-img circle"  style="width: 50px;height: 50px;" src="{{$cocina -> img_profile}}"></td>
                                <td>{{$cocina->full_name}}</td>
                                <td>{{$cocina->email}}</td>
                                <td>
                                    <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                    @if($cocina->status == true)
                                        <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                    @else
                                        <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </li>

        <li>
            <div class="collapsible-header"></i>Mesonero</div>
            <div class="collapsible-body">
                <table class="striped centered responsive-table">
                    @include('partials.admin.UserTable')
                    <tbody>
                    @foreach($users as $mesonero)
                        @if($mesonero->type == 'mesonero')
                            <tr data-id="{{$mesonero -> id}}" data-fullname="{{$mesonero->full_name}}">
                                <td><img class="responsive-img circle"  style="width: 50px;height: 50px;" src="{{$mesonero -> img_profile}}"></td>
                                <td>{{$mesonero->full_name}}</td>
                                <td>{{$mesonero->email}}</td>
                                <td>
                                    <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 EditUser" data-position="top" data-delay="50" data-tooltip="Editar"><i class="tiny mdi-editor-mode-edit "></i></a>
                                    @if($mesonero->status == true)
                                        <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Desactivar"><i class="tiny mdi-action-done "></i></a>
                                    @else
                                        <a href="#" class="btn tooltipped col s4 offset-s4 l2 offset-l1 softDeleteUser" data-position="top" data-delay="50" data-tooltip="Activar"><i class="tiny mdi-notification-do-not-disturb "></i></a>
                                    @endif
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

@endsection
