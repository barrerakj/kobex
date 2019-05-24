$(function(){

    $(".btnGuardar").on("click", function(){
        let id = $("#id").val();
        let nombre = $("#nombre").val();
        let apellido = $("#apellido").val();
        let telefono1 = $("#telefono1").val();
        let telefono2 = $("#telefono2").val();
        let direccion = $("#direccion").val();
        let otros = $("#otros").val();

        if(nombre == '')
            alert("Porfavor ingrese al menos un nombre.");
        else if(apellido == '')
            alert("Porfavor ingrese al menos un apellido.");
        else if(telefono1 == '')
            alert("Porfavor ingrese al menos un numero de telefono.");
        else {

            $.post(base_url + "cliente/guardar/" + id,
            {
                _nombre: nombre,
                _apellido: apellido,
                _telefono1: telefono1, 
                _telefono2: telefono2,
                _direccion: direccion,
                _otros: otros,
                _token: token
            },
            function(data){
                let result = JSON.parse(data);
                if(result[0]){
                    $(".toast-body").html("La información se ha guardado con éxito.");
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

});
