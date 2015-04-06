$(document).ready(function(){
    //Collapsible de los usuarios
    $('.collapsible').collapsible()

    //Sudmits para los modales - crear
    $('#crear_userSubmit').click(function () {
        $(this).ajaxStore('#crear_userForm',"Usuario Creado Correctamente")
    });
})