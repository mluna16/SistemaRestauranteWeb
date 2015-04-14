$('.changePasswordSubmit').click(function () {
    console.log("dffd")
    $(this).ajaxStore('#changePasswordForm',"Cambio de contraseña exitoso","changePasswordSuccess"," last_id")
});