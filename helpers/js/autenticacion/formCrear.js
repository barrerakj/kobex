$(function(){

    var base_url = "http://localhost/kobex/";

    $(".btn-crear").on("click", function(){
        let _nombre = $("#nombre").val();
        let _apellido = $("#apellido").val();
        let _telefono = $("#telefono").val();
        let _direccion = $("#direccion").val();
        let _correo = $("#correo").val();
        let _pass1 = $("#pass1").val();
        let _pass2 = $("#pass2").val();
        let _plan = $('input[name=radio]:checked', '.container').val();
        emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;

        if(_nombre != ""){
            if(_correo != ""){
                if(emailRegex.test(_correo)){
                    if(_pass1 != "" || _pass2 != ""){
                        if(_pass1 == _pass2){
                            $.post(base_url + "aut/nuevo",
                            {
                                nombre: _nombre,
                                apellido: _apellido,
                                telefono: _telefono,
                                direccion: _direccion,
                                correo: _correo,
                                pass: _pass1,
                                plan: _plan

                            }, 
                            function(data){
                                let result = JSON.parse(data);
                                alert(result);
                                if(result[0] == true){
                                    window.location.replace(base_url + "aut/confirmar");
                                } else {
                                    $(".toast-body").html("Hemos experimentado un error al intentar crear su cuenta. Por favor, contacte al administrador.");
                                    $(".toast").toast("show");
                                }
                            });
                        } else {
                            alert("Las contraseñas no coinciden, intentelo de nuevo.")
                        }
                    } else {
                        alert("Asegurese de introducir la misma contraseña en los dos campos indicados")
                    }
                } else {
                    alert("Ha ingresado una dirección de correo inválida.")
                }
            } else {
                alert("El correo electrónico es un campo obligatorio.")
            }

        } else {
            alert("Por favor, ingrese por lo menos el nombre.")
        }
    });
});
