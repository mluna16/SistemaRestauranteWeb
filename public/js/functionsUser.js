$('.changePasswordSubmit').click(function () {
    var url = $('#changePasswordForm').attr('action');
    $(this).ajaxStore('#changePasswordForm',url,"Cambio de contraseña exitoso","changePasswordSuccess"," last_id")
});