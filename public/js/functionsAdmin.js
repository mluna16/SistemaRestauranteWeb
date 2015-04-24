$(document).ready(function(){
    //Collapsible de los usuarios
    $('.collapsible').collapsible()
    //Tooltip materialize
    $('.tooltipped').tooltip({delay: 50});


    /*
     --USERS--
     */
    //Sudmits para los modales - crear
    $('#crear_userSubmit').click(function () {
        var  form = $('#crear_userForm');
        var url = form.attr('action')
        $(this).ajaxStore('#crear_userForm',url,"Usuario Creado Correctamente","crearUserSuccess","form")
    });

    $('.editUserSubmit').click(function () {
        var  form = $('#editUserForm');
        var id = $(this).attr('data-id');
        var url = form.attr('action').replace(':USER_ID', id);
        $(this).ajaxStore('#editUserForm',url,"Usuario Editado","UserEditSuccess","form")
    });

    // modales de softDeleteUser
    $('.submitSoftDelete').click(function () {
        var  form = $('#formSoftDeleteUser');
        var id = $(this).attr('data-id')
        var url = form.attr('action').replace(':USER_ID', id);
        $(this).ajaxStore('#formSoftDeleteUser',url,"Usuario actualizado","softDeleteUserSuccess","'.changeActionSoftDelete'")
    });

    //Modal

    $('.softDeleteUser').click(function(){
        $('.headerSoftDeleteUser,.fullNameSoftDeleteUser').empty()
        $('.submitSoftDelete').attr('data-id',"")
        $(this).removeClass('changeActionSoftDelete');
        var action = $(this).attr('data-tooltip')
        var fullname = $(this).parent().parent().parent().attr('data-fullname')
        var id = $(this).parent().parent().parent().attr('data-id')
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
        var id = $(this).parent().parent().parent().attr('data-id')
        var url = '../users/'+id;
        $(this).ajaxGetData(url,'DataEditUser','data')
    });




    /*
     --PRODUCTS--
     */

    $('.crear_menuSubmit').click(function () {
        var  form = $('#crear_menuForm');
        var url = form.attr('action')
        $(this).ajaxStore('#crear_menuForm',url,"Menu Creado Correctamente","crearMenuSuccess","'.dropzone' , last_id")
    });

    $(document).on('click','.submitSoftDeleteProduct',function(event){
        var  form = $('#formSoftDeleteProduct');
        var id = $(this).attr('data-id')
        var action = $(this).attr('data-action')
        var url = form.attr('action').replace(':PRODUCT_ID', id);

        if(action=='Eliminar'){
            $(this).ajaxStore('#formSoftDeleteProduct',url+'/2',"Producto Eliminado","deleteProductSuccess","'#CardMenu"+id+"'")
        }else{
            $(this).ajaxStore('#formSoftDeleteProduct',url+'/1',"Producto actualizado","softDeleteUserSuccess","'.changeActionSoftDelete'")
        }
    });

    //SoftdeleteProduct
    $(document).on('click','.softDeleteProduct',function(event){
        $('.headerSoftDeleteProduct,.ProductNameSoftDeleteProduct').empty()
        $('.submitSoftDeleteProduct').attr('data-id',"")
        $(this).removeClass('changeActionSoftDelete');
        var action = $(this).attr('data-tooltip')
        var ProductName = $(this).attr('data-name')
        var id = $(this).attr('data-id')
        $('.submitSoftDeleteProduct').attr('data-id',id)
        $('.submitSoftDeleteProduct').attr('data-action',action)
        $('.headerSoftDeleteProduct').append($('<span>'+action+'</span>'));
        $('.ProductNameSoftDeleteProduct').append($('<span>'+ProductName+'</span>'));
        $(this).addClass('changeActionSoftDelete');
        $('.modalSoftDeleteProduct').openModal();
    });

    $('.EditProduct').click(function(){
        var id = $(this).attr('data-id')
        var url = 'producto/'+id;
        $(this).ajaxGetData(url,'DataEditProduct','data')
    });


    $('.editProductSubmit').click(function () {
        var  form = $('#EditmenuForm');
        var id = $(this).attr('data-id');
        var url = form.attr('action').replace(':PRODUCT_ID', id);
        $(this).ajaxStore('#EditmenuForm',url,"Producto Editado","ProductEditSuccess","form")
    });


    /*
     --LOCAL--
     */

    $('.crear_localSubmit').click(function () {
        var  form = $('#crear_localForm');
        var url = form.attr('action')
        $(this).ajaxStore('#crear_localForm',url,"Local Creado Correctamente","crearlocalSuccess","'.dropzone' , last_id")
    });

})