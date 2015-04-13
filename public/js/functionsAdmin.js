$(document).ready(function(){
    //Collapsible de los usuarios
    $('.collapsible').collapsible()

    //Sudmits para los modales - crear
    $('#crear_userSubmit').click(function () {
        $(this).ajaxStore('#crear_userForm',"Usuario Creado Correctamente","crearUserSuccess","form")
    });

    $('.crear_menuSubmit').click(function () {
        $(this).ajaxStore('#crear_menuForm',"Menu Creado Correctamente","crearMenuSuccess","'.dropzone' , last_id")
    });

    $('.crear_localSubmit').click(function () {
        $(this).ajaxStore('#crear_localForm',"Local Creado Correctamente","crearlocalSuccess","'.dropzone' , last_id")
    });



})