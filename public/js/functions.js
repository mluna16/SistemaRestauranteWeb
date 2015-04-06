$(document).ready(function(){
    // Dropdown Menu para el perfil de usuarios
        $('.dropdown-button').dropdown({

                inDuration: 300,
                outDuration: 225,
                constrain_width: false,
                hover: true,
                alignment: 'right',
                gutter: 10,
                belowOrigin: true
            }
        );
    //Modales
    $('.modal-trigger').leanModal()

    // Select

    $('.tipoDeUsuario').material_select();


    //Funciones ajax
    $.fn.ajaxStore = function(idForm,successMessage) {
        $('body').append("<div class='preloader-wrapper big active' style='position: fixed;left: 85%; margin-top: 5%;top: 5%;z-index: 1000;'> <div class='spinner-layer spinner-blue'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-red'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-yellow'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-green'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> </div>")
        var form = $(idForm);
        var data = form.serialize();
        var url = form.attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function (data) {
                $('.preloader-wrapper').hide();
                Materialize.toast(successMessage, 4000)
                form[0].reset();
                $('.modal').closeModal();
            },
            error: function (data) {
                var errors = data.responseJSON;
                $('.preloader-wrapper').hide();
                if (errors) {
                    $.each(errors, function (i) {
                        Materialize.toast(errors[i], 3000);
                    });
                }

            }
        });
    }
});