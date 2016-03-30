$(document).ready(function(){


    //Modales
    $('.modal-trigger').leanModal()

    $('.collapsible').collapsible()

    // Select
    $('.tipoDeUsuario').material_select();


    //Funciones ajax
    $.fn.ajaxStore = function(idForm,urlForm,successMessage,afunction,params) {
        var form = $(idForm);
        var data = form.serialize();
        var type = form.attr('method');
        $.ajax({
            type: type,
            url: urlForm,
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
    $.fn.ajaxGetData = function(url,afunction,params) {
        $('body').append("<div class='preloader-wrapper big active' style='position: fixed;left: 85%; margin-top: 5%;top: 5%;z-index: 1000;'> <div class='spinner-layer spinner-blue'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-red'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-yellow'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-green'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> </div>")
        $.ajax({
            type: 'Get',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('.preloader-wrapper').hide();
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
     $.fn.ajaxGetPageLoader = function(url,id) {
        $('body').append("<div class='preloader-wrapper big active' style='position: fixed;left: 85%; margin-top: 5%;top: 5%;z-index: 1000;'> <div class='spinner-layer spinner-blue'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-red'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-yellow'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> <div class='spinner-layer spinner-green'> <div class='circle-clipper left'> <div class='circle'></div> </div> <div class='gap-patch'> <div class='circle'></div> </div> <div class='circle-clipper right'> <div class='circle'></div> </div> </div> </div>")
         $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $(id).empty().append($(data));
                $('.preloader-wrapper').hide();
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
        imageDropZone.options.url = "productImg/"+id;
        $(form).attr('action').replace('MENU_ID', id);

    }
    $(".menuPaso2Atras").click(function(){
        $(".crear_menuSubmit").addClass("crear_menuSubmitNone")
        $(".crear_menuSubmit").removeClass("crear_menuSubmit")

    })
    $(".crear_menuSubmitnone ").click(function(){
        $( ".menuPaso1" ).hide()
        $( ".menuPaso2" ).show();
    })

    $(document).on('click','#menu2success',function(){

        console.log("entro")
        $("#resetmenu").trigger( "click" )
        $('#create_menu').closeModal();
        $( ".menuPaso1" ).show()
        $( ".menuPaso2" ).hide();    })

    //DropZone
    //DropZone de Menu

    Dropzone.options.crearMenuFormImages={

        autoProcessQueue: true,
        maxFilesize: 0.5,
        acceptedFiles: ".jpg, .jpeg, .png",
        maxFiles:5,
        success: function(){
            $(this).ajaxGetPageLoader('Menu','#principalPanel')
        }
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

    //Funciones cambio password

    function changePasswordSuccess(id){
        location.reload().delay( 3000 );
    }

    $('.changePasswordPaso0').click(function(){
        $( ".changePassworPaso0, .changePasswordPaso0" ).hide()
        $( ".changePasswordPaso1, .changePasswordSubmit" ).show();
    })

    function softDeleteUserSuccess(that){
        if($(that).attr('data-tooltip')=='Activar'){
            $(that).children().removeClass('mdi-notification-do-not-disturb')
            $(that).children().addClass('mdi-action-done')
            $(that).attr('data-tooltip','Desactivar')
            $(that).removeClass('changeActionSoftDelete')
        }else{
            $(that).children().removeClass('mdi-action-done')
            $(that).children().addClass(' mdi-notification-do-not-disturb')
            $(that).attr('data-tooltip','Activar')
            $(that).removeClass('changeActionSoftDelete')
        }
        $('.modal').closeModal();

    }

    function DataEditProduct(data){
        activeLabelForm('#EditmenuForm');
        $('.nameProduct').val(data['name'])
        $('.costProduct').val(data['cost'])
        $('.limitProduct').val(data['limit'])
        $('.descriptionProduct').val(data['description'])
        $('.editProductSubmit').attr('data-id',data['id']);
        $('#editMenu').openModal();

    }

    //Editar usuario

    function DataEditUser(data){
        activeLabelForm('#editUserForm');
        $('.firstNameUser').val(data['first_name']);
        $('.lastNameUser').val(data['last_name']);
        $('.emailUser').val(data['email']);
        $('.typeUser').val(data['type']);
        $('#editUserSubmit').attr('data-id',data['id']);
        $('#EditUserModal').openModal();
    }

    function UserEditSuccess(form){
        form[0].reset();
        CleanForm(form);
        CleanForm('#crear_userForm')
        $('.modal').closeModal();
        $(this).ajaxGetPageLoader('Usuarios','#principalPanel')
        $('.collapsible').collapsible()


    }
    function ProductEditSuccess(form){
        form[0].reset();
        CleanForm(form);
        CleanForm('#create_menu')
        $('#editMenu').closeModal();
        $(this).ajaxGetPageLoader('Menu','#principalPanel')
    }
    function deleteProductSuccess(card){
        card = $(card);
        //card.fadeOut();
        $('.modalSoftDeleteProduct').closeModal();
        $(this).ajaxGetPageLoader('Menu','#principalPanel')
    }


    //Editar local

    function DataEditLocal(data){
        activeLabelForm('#editLocalForm');
        $('.localName').val(data['name']);
        $('.localNumberTables').val(data['number_tables']);
        $('.localLocation').val(data['location']);
        $('.localRif').val(data['rif']);
        $('.LocalEditSubmit').attr('data-id',data['id']);
        $('#Editlocal').openModal();
    }

    function LocalEditSuccess(form){
        form[0].reset();
        CleanForm(form);
        $('#Editlocal').closeModal();
        ajaxGetPageLoader('Restaurante','#principalPanel')

    }
    //Funciones Generales
    function activeLabelForm(idForm){
        idForm = $(idForm);

        idForm.find(':input').each(function(){
            if($(this).val()!= " " ){
                $(this).next().addClass('active');
            }
        })
    }
    function CleanForm(idForm) {
        idForm = $(idForm);
        idForm.find(':input').each(function () {
            if (!$(this).hasClass("hidden")) {
                $(this).val("");
            }
        });
    }


    function infopedido(data){
        console.log(data);
        var struct = '<div class="row"> <div class="col s12 126"> <div class="card "> <div class="card-content"> <span class="card-title light-blue-text text-lighten-1 ">Mesa numero '+data['data']['NumberTable'] +'</span> <table class="responsive-table hoverable  "> <thead> <tr> <th data-field="producto">Producto</th> <th data-field="precio">Precio</th> <th data-field="estado">Estado</th> </tr> </thead> <tbody>';
        var pedido = data['data']['Pedidos']
        $.each(pedido, function (index, val){
            struct += '<tr data-id="' + 1 + '" style="cursor: pointer;">'
                            + '<td>' + val['ProductName'] + '</td>'
                            + '<td>' + val['ProductCost'] + '</td>'
                            + '<td>' + val['OrderState'] +'</td>'
            struct += '</tr>';
            if(val['Extra'] !=null) {
                $.each(val['Extra'], function (inde, value) {
                    struct += '<tr data-id="' + 1 + '" style="cursor: pointer;">'
                    + '<td>' + value['nombreExtra'] + '</td>'
                    + '<td>' + value['costExtra'] + '</td>'
                    + '<td>' + val['OrderState'] + '</td>'
                    struct += '</tr>';
                });
            }
        });
        struct += '</tbody> </table> </div> <div class="card-action"> <div class="row"> <div class="col m6"> <h5>Total Bs : '+data['data']['CostTable']+'</h5> </div>';
        if(pedido[0]['Facturar']== 1){
            struct += '<div class="col m6"> <a data-id ="'+data['data']['NumberTable']+'" class="waves-effect waves-light btn right facturar">Facturar</a> </div> </div> </div> </div> </div> </div>'

        }else {
            struct += '<div class="col m6"> <a class="btn disabled right ">Facturar</a> </div> </div> </div> </div> </div> </div>'
        }
        $('#infoPedido').empty().append($(struct));
    }

    $(document).on('click','.facturar', function(event){
        var id = $(this).attr('data-id')
        var url = 'caja/invoiceDatails/'+id;
        $(this).ajaxGetData(url,'inoviceDetails','data')
    });

    function inoviceDetails(data){
        activeLabelForm('#EditmenuForm');
        $('#modalPrincipal').append($(data['data']))
        $('#create_invoice').openModal();
    }

    $(document).on('click','#crear_InvoiceSubmit',function () {
        var  form = $('#crear_invoiceForm');
        var id = $(this).attr('data-id')
        var url = form.attr('action')
        $(this).ajaxStore('#crear_invoiceForm',url,"Factura Generada","invoiceGenerateSuccuess","data")
    });

    function invoiceGenerateSuccuess(data){

        $('#create_invoice').closeModal();
        $('#modalPrincipal').empty();

        window.open(data['url'], '_blank');

    }

    /*
    *
    * Modals
     */
    $(document).on('click','#create_user_modal',function(){
        $(this).ajaxGetData('modaluser','generateModalCreateUser','data')
   })
    function generateModalCreateUser (data){
        console.log('entrando')
        $('#modalPrincipal').empty().append($(data));
        $('.preloader-wrapper').hide();
        $('#create_user').openModal();
    }

    $(document).on('click','#create_menu_modal',function(){
        $(this).ajaxGetData('modalmenu','generateModalCreateMenu','data')
    })
    function generateModalCreateMenu (data){
        console.log('entrando')
        $('#modalPrincipal').empty().append($(data));
        $('.preloader-wrapper').hide();
        $('#create_menu').openModal();
        Dropzone.options.crearMenuFormImages = {
            autoProcessQueue: true,
            maxFilesize: 0.5,
            acceptedFiles: ".jpg, .jpeg, .png",
            maxFiles: 5
        };
    }

    /*
    *
    *  Funciones de Charts y Estadisiticas
    *  */
    $.fn.charPieFunction = function (id,data){
        $(id).highcharts({
            chart: {
                type: 'pie'
            },
            title: {
                text: null
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: "Brands",
                colorByPoint: true,
                data: data
            }]
        });
    }

    $.fn.charBarFunction = function(id,data){
        $(id).highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: null
            },
            subtitle: {
                text: null
            },
            xAxis: {

                categories: [
                    null
                ],
                crosshair: true
            },
            yAxis: {
                min: null,
                title: {
                    text: 'Ganancias Totales'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
                footerFormat: '</table>'

            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: data
        });
    }
});