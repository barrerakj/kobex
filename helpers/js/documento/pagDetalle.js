$(function(){

    var versiones = '';
    var documento = '';
    
    function listar_versiones(){
        $.post(base_url + "doc/obtener",
        {
            _token: token
        },        
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let cliente = result[1][0];
                documento = result[2][0];
                versiones = result[3];

                $(".infoClienteDocumento").html(`
                    <h5>Cliente: `+ cliente['name'] +` `+ cliente['lastname'] +`</h5>
                    <h5>Documento: `+ documento['name'] +`</h5>
                `);

                let table_content = '';
                for (let i = 0; i < versiones.length; i++) {
                    table_content += `
                        <tr>
                            <th scope="row">`+ (i+1) +`</th>
                            <td>`+ versiones[i]['name'] +` `+versiones[i]['lastname'] +`</td>
                            <td>`+ versiones[i]['created_at'] +`</td>
                            <td>`+ versiones[i]['description'] +`</td>
                            <td>
                                <button class="btn btn-outline-secondary btn-sm btnPrevia" value="`+ versiones[i]['id'] +`">Previa</button>
                            </td>
                        </tr>
                    `;                    
                }
                $(".tbody").html(table_content);

                crear_acciones(documento['done']);
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

    function crear_acciones($listo){
        if($listo == 'no'){
            $(".AccionesDocumento").html(`
            <div class="col-4">
                <a href="`+ base_url + `doc/actualizar/` + documento['id'] +`" class="btn btn-outline-secondary">Agregar nueva versión</a>
            </div>
            <div class="col-4" style="max-width: none; padding-right: 0;">
                <button type="button" class="btn btn-secondary btnFinalizar" value="`+ documento['id'] +`">Marcar como finalizado</button>
            </div>
            `);
        }

        if($listo == 'yes'){
            $(".AccionesDocumento").html(`
            <div class="col-4" style="max-width: none; padding-right: 0;">
                <button type="button" class="btn btn-secondary btnReanudar" value="`+ documento['id'] +`">Reanudar documento</button>
            </div>
            `);
        }
    }

    $(".table").on("click", ".btnPrevia", function(){
        let id = $(this).val();
        for (let i = 0; i < versiones.length; i++) {
            if(versiones[i]['id'] == id){
                let ruta_absoluta = base_url + versiones[i]['path'];
                console.log(ruta_absoluta);
                $(".DocView").html('');
                $(".DocView").html(`
                    <p> Versión #` + (i+1) + `</p>
                    <iframe style="width: 100%; height: 700px;" src='https://view.officeapps.live.com/op/embed.aspx?src=`+ ruta_absoluta +`' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
                    <br><br>
                    <a href="` + ruta_absoluta + `" target=_blank class="btn btn-outline-secondary">Descargar Documento</a>
                    <br><br>
                `);
            }
        }
    });

    $(document).on("click", ".btnFinalizar", function(){
        let id = $(this).val();
        $.post(base_url + "doc/finalizar/"+ id, 
        {
            _token: token
        }, 
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                $(".toast-body").html("El documento se ha marcado como finalizado. Puede ver el historial en Menu->Documentos->Archivados.");
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
    });

    $(document).on("click", ".btnReanudar", function(){
        let id = $(this).val();
        $.post(base_url + "doc/reanudar/"+ id, 
        {
            _token: token
        }, 
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                $(".toast-body").html("El documento esta disponible de nuevo. Puede encontrarlo en Menu->Documentos->En Proceso.");
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
    });

    listar_versiones();
});