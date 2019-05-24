$(function(){

    var plantillas = "";

    function listado_plantillas(){
        $.post(base_url + "plant/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                plantillas = result[1];
                let table_content = "";
                for (let i = 0; i < plantillas.length; i++) {
                    table_content += `
                        <tr>
                            <th scope="row">`+ plantillas[i]["id"] +`</th>
                            <td>`+ plantillas[i]["name"] +`</td>
                            <td>
                                <button value="`+ plantillas[i]["id"] +`" class="btn btn-outline-secondary btn-sm btnVer">Ver</button> 
                                <button value="`+ plantillas[i]["id"] +`" class="btn btn-outline-danger btn-sm btnEliminar">Eliminar</button>
                            </td>
                        </tr>
                    `;
                }
                $(".tbody").html(table_content);
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

    $(".table").on("click", ".btnVer", function(){
        let id = $(this).val();
        let ruta = "";
        let nombre = "";
        for (let i = 0; i < plantillas.length; i++) {
            if(plantillas[i]["id"] == id){
                ruta = plantillas[i]["path"];
                nombre = plantillas[i]["name"];
            }
        }

        let ruta_absoluta = base_url + ruta;

        $(".DocView").html('');

        $(".DocView").html(`
            <p>` + nombre + `</p>
            <iframe style="width: 100%; height: 700px;" src='https://view.officeapps.live.com/op/embed.aspx?src=`+ ruta_absoluta +`' width='1366px' height='623px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>
            <br><br>
            <a href="` + ruta_absoluta + `" target=_blank class="btn btn-outline-secondary">Descargar Documento</a>
            <br><br>
        `);
    });

    $(".table").on("click", ".btnEliminar", function(){
        let id = $(this).val();
        $.post(base_url + "plant/eliminar/" + id,
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                if(result[1]){
                    $(".toast-body").html("La plantilla se ha eliminado con éxito.");
                    $(".toast").toast("show");
                    $(".tbody").empty();
                    listado_plantillas();
                } else {
                    $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                    $(".toast").toast("show");
                }
            } else {
                window.location.replace(result[1]);
            }
        });
    });

    listado_plantillas();

});