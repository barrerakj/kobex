$(function(){
    
    $(".btnMostrarPass").on("click", function(){
        $(this).hide();
        $(".actualizar-pass").slideDown();
    });

    $(".btnActualizarPass").on("click", function(){
        let pass_actual = $("#pass-actual").val();
        let pass_nuevo = $("#pass-nuevo").val();
        let pass_nuevo1 = $("#pass-nuevo1").val();

        if(pass_actual != "" && pass_nuevo != "" && pass_nuevo1 != ""){
            if(pass_nuevo == pass_nuevo1){
                $.post(base_url + "usuario/actualizar_pass",
                {
                    _pass: pass_actual,
                    _nuevo: pass_nuevo,
                    _token: token
                },
                function(data){
                    let result = JSON.parse(data);
                    if(result[0]){
                        $(".toast-body").html("La contraseña ha sido actualizada con éxito.");
                        $(".toast").toast("show");
                        
                        $(".actualizar-pass").slideUp();
                        $("#pass-actual").val("");
                        $("#pass-nuevo").val("");
                        $("#pass-nuevo1").val("");
                        $(".btnMostrarPass").show()
                        
                    } else {
                        if(typeof result[1] == "undefined"){
                            $(".toast-body").html("Se ha experimentado un error. Es posible que su contraseña actual haya sido introducida incorrectamente. Por favor, intente de nuevo o contacte al administrador.");
                            $(".toast").toast("show");
                        } else {
                            window.location.replace(result[1]);
                        }
                    }
                });
            } else{
                $(".toast-body").html("No se puede realizar la actualización de contraseña. Los campos para la nueva contraseña no coinciden.");
                $(".toast").toast("show");
            }
        } else {
            $(".toast-body").html("No se puede realizar la actualización de contraseña. Uno de los campos esta vacío.");
            $(".toast").toast("show");
        }
    });

    $(".btnGuardar").on("click", function(){
        let nombre = $("#nombre").val();
        let apellido = $("#apellido").val();
        let direccion = $("#direccion").val();
        let telefono = $("#telefono").val();
        let descripcion = $("#descripcion").val();

        if(nombre == ""){
            alert("El campo Nombre no puede estar vacio.")
        } else {
            $.post(base_url + "usuario/actualizar",
            {
                _nombre: nombre,
                _apellido: apellido,
                _direccion: direccion,
                _telefono: telefono,
                _descripcion: descripcion,
                _token: token
            },
            function(data){
                let result = JSON.parse(data);
                if(result[0]){
                    $(".toast-body").html("Los datos personales se han actualizado con éxito.");
                    $(".toast").toast("show");
                } else {
                    if(typeof result[1] == "undefined"){
                        $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                        $(".toast").toast("show");
                    } else {
                        window.location.replace(result[1]);
                    }
                }
            });
        }
    });

    $.post(base_url + "usuario/obtener",
    {
        _token: token
    },
    function(data){
        let result = JSON.parse(data);
        if(result[0]){
            let usuario = result[1];
            let plan = result[3];
            $("#correo").val(usuario[0]['email']);
            $("#nombre").val(usuario[0]['name']);
            $("#apellido").val(usuario[0]['lastname']);
            $("#direccion").val(usuario[0]['address']);
            $("#telefono").val(usuario[0]['phone']);
            $("#descripcion").val(usuario[0]['more']);

            $("#asociado").val(plan[0]['name'] + " " +plan[0]['lastname']);
            $("#plan").val(plan[0]['plan_name']);
            $("#fecha").val(plan[0]['expires']);            
            
        } else {
            if(typeof result[1] == "undefined"){
                $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                $(".toast").toast("show");
            } else {
                window.location.replace(result[1]);
            }
        }
    });
});