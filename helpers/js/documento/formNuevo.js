$(function(){

    var plantillas = '';

    function listado_plantillas(){
        $.post(base_url + "plant/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                plantillas = result[1];
                let select_content = "";
                for (let i = 0; i < plantillas.length; i++) {
                    select_content += `
                        <option value="`+ plantillas[i]['id'] +`">`+ plantillas[i]['name'] +`</option>
                    `;  
                }
                $(".sltPlantillas").html(select_content);
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

    function listado_clientes(){
        $.post(base_url + "cliente/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let clients = result[1];
                let select_content = "";
                for (let i = 0; i < clients.length; i++) {
                    select_content += `
                        <option value="`+ clients[i]['id'] +`">` + clients[i]['name'] + ` ` + clients[i]['lastname'] +`</option>
                    `;
                }
                $(".sltClientes").html(select_content);
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

    $(".sltPlantillas").on("change", function(){
        let id = $(this).val();
        let ruta = '';
        for (let i = 0; i < plantillas.length; i++) {
            if(plantillas[i]['id'] == id)
                ruta = plantillas[i]['path'];            
        }
        let ruta_absoluta = base_url + ruta;
        let html = `
            <a href="` + ruta_absoluta + `" target=_blank class="btn btn-outline-secondary btn-sm">Descargar Plantilla</a>
            <br>
        `;
        $("#descargar_plantilla").slideUp('slow');
        $("#descargar_plantilla").html('');
        $("#descargar_plantilla").html(html);
        $("#descargar_plantilla").slideDown('slow');
    });

    $(".btnGuardar").on("click", function(){
        let nombre = $("#nombre").val();
        let idPlantilla = $(".sltPlantillas").val();
        let idCliente = $(".sltClientes").val();
        let descripcion = $("#descripcion").val();
        let formData = new FormData();

        if( document.getElementById("archivo").files.length == 0 ){
            alert("Porfavor seleccione un archivo.");
        } else {
            formData.append('files[]', document.getElementById('archivo').files[0]);

            $.post(base_url + "doc/guardar",
            {
                _nombre: nombre,
                _idPlantilla: idPlantilla,
                _idCliente: idCliente,
                _descripcion: descripcion,
                _token: token
            },
            function(data){
                let result = JSON.parse(data);
                if(result[0]){

                    fetch(base_url + "doc/archivo", {
                        method: 'POST',
                        body: formData
                    }).then((res) => { return res.json() })
                    .then(function (data) {
                        let result2 = data;
                        if(result2[0]){
                            window.location.replace(base_url + "doc/detalle/" + result2[1]);
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
        
        
    });

    listado_plantillas();
    listado_clientes();
    
});