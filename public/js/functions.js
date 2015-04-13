$(document).ready(function(){
    // Dropdown Menu para el perfil de usuarios
    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrain_width: false, // Does not change width of dropdown to that of the activator
        hover: true, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true // Displays dropdown below the button
    });

    //Modales
    $('.modal-trigger').leanModal()



    // Select
    $('.tipoDeUsuario').material_select();


    //Funciones ajax
    $.fn.ajaxStore = function(idForm,successMessage,afunction,params) {
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
                last_id = data['last_id'];
                Materialize.toast(successMessage, 4000)
                eval(afunction + "("+params+")");
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
    //Funciones internas de los Modal de User
    function crearUserSuccess(form){
            form[0].reset();
            $('.modal').closeModal();
        }

    //Funciones internas de los Modal de Menu

    function crearMenuSuccess(form,id){
            $( ".menuPaso1, .crear_menuSubmit" ).hide()
            $( ".menuPaso2" ).show();
            $(form).attr('action').replace('MENU_ID', id);
        }
        $(".menuPaso2Atras").click(function(){
            $(".crear_menuSubmit").addClass("crear_menuSubmitNone")
            $(".crear_menuSubmit").removeClass("crear_menuSubmit")
            $( ".menuPaso1" ).show()
            $( ".menuPaso2" ).hide();
        })
        $(".crear_menuSubmitnone ").click(function(){
            $( ".menuPaso1" ).hide()
            $( ".menuPaso2" ).show();
        })

    //DropZone
        //DropZone de Menu
        Dropzone.options.crearMenuFormImages={
            autoProcessQueue: true,
            maxFilesize: 0.5,
            acceptedFiles: ".jpg, .jpeg, .png",
            maxFiles:5
        };
        //DropZone de Local
    $(function() {
        Dropzone.options.crearLocalFormImages={
            autoProcessQueue: true,
            maxFilesize: 0.5,
            acceptedFiles: ".jpg, .jpeg, .png",
            maxFiles:1,
            success: function(){
                Materialize.toast("Imagen cargada correctamente, Bienvenido", 4000)

                location.reload().delay( 3000 );
            }
        };
    });


    //Funciones de Crear Local
    function crearlocalSuccess(form,id){
        $( ".localPaso1, .crear_localSubmit" ).hide()
        $( ".localPaso2" ).show();
        $(form).attr('action').replace('local_ID', id);
    }
    $('.crear_localPaso0').click(function(){
        $( ".localPaso0, .crear_localPaso0" ).hide()
        $( ".localPaso1, .crear_localSubmit" ).show();
    })

    $(".localPaso2Atras").click(function(){
        $(".crear_localSubmit").addClass("crear_localSubmitNone")
        $(".crear_localSubmit").removeClass("crear_localSubmit")
        $( ".localPaso1, .crear_localSubmitnone" ).show()
        $( ".localPaso2" ).hide();
    })
    $(".crear_menuSubmitnone ").click(function(){
        $( ".localPaso1" ).hide()
        $( ".localPaso2" ).show();
    })



});