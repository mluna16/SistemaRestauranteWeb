$(document).ready(function(){
    //Collapsible de los usuarios
    $('.collapsible').collapsible()
    //Tooltip materialize
    $('.tooltipped').tooltip({delay: 50});
    //Sudmits para los modales - crear
    $('#crear_userSubmit').click(function () {
        var  form = $('#crear_userForm');
        var url = form.attr('action')
        $(this).ajaxStore('#crear_userForm',url,"Usuario Creado Correctamente","crearUserSuccess","form")
    });

    $('.crear_menuSubmit').click(function () {
        var  form = $('#crear_menuForm');
        var url = form.attr('action')
        $(this).ajaxStore('#crear_menuForm',url,"Menu Creado Correctamente","crearMenuSuccess","'.dropzone' , last_id")
    });

    $('.crear_localSubmit').click(function () {
        var  form = $('#crear_localForm');
        var url = form.attr('action')
        $(this).ajaxStore('#crear_localForm',url,"Local Creado Correctamente","crearlocalSuccess","'.dropzone' , last_id")
    });
    $('.editUserSubmit').click(function () {
        var  form = $('#editUserForm');
        var id = $(this).attr('data-id');
        var url = form.attr('action').replace(':USER_ID', id);
        $(this).ajaxStore('#editUserForm',url,"Usuario Editado","UserEditSuccess","form")
    });


    // modales de softDelete
    $('.submitSoftDelete').click(function () {
        var  form = $('#formSoftDeleteUser');
        var id = $(this).attr('data-id')
        var url = form.attr('action').replace(':USER_ID', id);
        $(this).ajaxStore('#formSoftDeleteUser',url,"Usuario actualizado","softDeleteUserSuccess","'.changeActionSoftDelete'")
    });

    $('.softDeleteUser').click(function(){
        $('.headerSoftDeleteUser,.fullNameSoftDeleteUser').empty()
        $('.submitSoftDelete').attr('data-id',"")
        $(this).removeClass('changeActionSoftDelete');
        var action = $(this).attr('data-tooltip')
        var fullname = $(this).parent().parent().attr('data-fullname')
        var id = $(this).parent().parent().attr('data-id')
        $('.submitSoftDelete').attr('data-id',id)
        $('.headerSoftDeleteUser').append($('<span>'+action+'</span>'));
        $('.fullNameSoftDeleteUser').append($('<span>'+fullname+'</span>'));
        $(this).addClass('changeActionSoftDelete');
        $('.modalSoftDeleteUser').openModal();
    })

    $('.closeSoftDelete').click(function(){
        $('.softDeleteUser').removeClass('changeActionSoftDelete')
    })


    //Editar Usuarios

    $('.EditUser').click(function(){
        var id = $(this).parent().parent().attr('data-id')
        var url = '../users/'+id;
        $(this).ajaxGetData(url,'DataEditUser','data')
    });







})