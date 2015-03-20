$(document).ready(function(){
    console.log('entre');
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

});