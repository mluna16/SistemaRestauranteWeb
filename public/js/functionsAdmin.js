$(document).ready(function(){
    //Collapsible de los usuarios

       // $('.collapsible').collapsible()

    //Tooltip materialize
    $('.tooltipped').tooltip({delay: 50});


    /*
     --USERS--
     */
    //Sudmits para los modales - crear
    $(document).on('click','#crear_userSubmit',function () {
        var  form = $('#crear_userForm');
        var url = form.attr('action')
        $(this).ajaxStore('#crear_userForm',url,"Usuario Creado Correctamente","crearUserSuccess","form")
        $('#modalPrincipal').empty()

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

    $(document).on('click','.crear_menuSubmit',function () {
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

    $(document).on('click','#closeMenuModal',function(){
        $('#create_menu').closeModal();

        $('#modalPrincipal').empty()
    })


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

    $(document).on('click','.EditProduct', function(event){
        var id = $(this).attr('data-id')
        var url = 'producto/'+id;
        $(this).ajaxGetData(url,'DataEditProduct','data')
    });


    $(document).on('click','.editProductSubmit',function(event){
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

    $(document).on('click','.EditLocal',function(event){
        var id = $(this).attr('data-id')
        var url = 'local/'+id;
        $(this).ajaxGetData(url,'DataEditLocal','data')
    });

    $(document).on('click','.LocalEditSubmit',function(event){
        var  form = $('#editLocalForm');
        var id = $(this).attr('data-id');
        var url = form.attr('action').replace(':LOCAL_ID', id);
        $(this).ajaxStore('#editLocalForm',url,"Usuario Editado","LocalEditSuccess","form")
    })

    /*
    --Estadisticas--
    */

    $(document).on('click','#eVenta',function(){
        $.get( "Estadisticas/venta/", function( data ) {
            $(this).charBarFunction("#ventasDia",data)
        });
        $.get( "admin/Estadisticas/ventas/", function( data ) {
            $(this).charBarFunction("#ventaSemana",data)
        })
        $.get( "Estadisticas/ventaa/", function( data ) {
            $(this).charBarFunction("#ventaAno",data)
        })
    })
    $(document).on('click','#eProducto',function(){
        $.get( "Estadisticas/producto/1", function( data ) {
            $(this).charPieFunction("#productosDia", data)
        })
        $.get( "Estadisticas/producto/7", function( data ) {
            $(this).charPieFunction("#productosSemana",data)
        });
        $.get( "Estadisticas/producto/30", function( data ) {
            $(this).charPieFunction("#productosMes",data)
        });
        $.get( "Estadisticas/producto/365", function( data ) {
            $(this).charPieFunction("#productosAno",data)
        });
    })
    $(document).on('click','#eMesonero',function(){
        $.get( "Estadisticas/mesonero/1", function( data ) {
            $(this).charPieFunction("#mesonerosDia",data)
        });
        $.get( "Estadisticas/mesonero/30", function( data ) {
            $(this).charPieFunction("#mesonerosSemana",data)
        });
    })



    $(document).on('click','.tourActive',function(){
        $('#eVenta').trigger('click');
        $('#userCaja').trigger('click');

    });


})