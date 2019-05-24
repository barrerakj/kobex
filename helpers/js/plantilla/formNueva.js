$(function(){

    $(".btnGuardar").on("click", function(){
        let nombre = $("#nombre").val();
        let descripcion = $("#descripcion").val();
        let formData = new FormData();

        if( document.getElementById("archivo").files.length == 0 ){
            alert("Porfavor seleccione un archivo.");
        } else {
            formData.append('files[]', document.getElementById('archivo').files[0]);

            if(nombre == '')
                alert("Porfavor ingrese un nombre para su plantilla.");
            else {
                $.post(base_url + "plant/guardar",
                {
                    _nombre: nombre,
                    _descripcion: descripcion,
                    _token: token
                },
                function(data){
                    let result = JSON.parse(data);
                    if(result[0]){

                        fetch(base_url + "plant/archivo", {
                            method: 'POST',
                            body: formData
                        }).then((res) => { return res.json() })
                        .then(function (data) {
                            let result2 = data;
                            if(result2[0]){
                                window.location.replace(base_url + "plant/listado");
                            } else {
                                $(".toast-body").html(result2[1]);
                                $(".toast").toast("show");
                            }
                        });
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
        }
    });
});

            