$(function(){

    function listado_casos(){
        $.post(base_url + "casos/listar-activos",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let cases = result[1];
                let table_content = "";
                for (let i = 0; i < cases.length; i++) {
                    
                    let clientNames = ''
                    cases[i].clients.forEach(e => {
                        clientNames += e.name + ' ' + e.lastname + ', '
                    });

                    let usersNames = ''
                    cases[i].users.forEach(e => {
                        usersNames += e.name + ' ' + e.lastname + ', '
                    });

                    table_content += `
                        <tr>
                            <th scope="row">`+ cases[i]["id"] +`</th>
                            <td>`+ cases[i]["name"] +`</td>
                            <td>`+ clientNames +`</td>
                            <td>`+ cases[i]["description"] +`</td>
                            <td>`+ usersNames +`</td>
                            <td>`+ cases[i]["created_date"] +`</td>
                            <td>
                                <a href="`+base_url+`caso/ver/`+ cases[i]["id"] +`" class="btn btn-outline-secondary far fa-eye" title="Ver los detalles del caso seleccionado."></a> 
                                <a href="`+base_url+`caso/editar/`+ cases[i]["id"] +`" class="btn btn-outline-secondary far fa-edit" title="Cambiar la información del caso seleccionado."></a>                                 
                                <button value="`+ cases[i]["id"] +`" class="btn btn-outline-danger btnArchivar far fa-window-close" title="Archiva el caso seleccionado, para que aparezca en Casos Archivados."></button>
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

    $(".table").on("click", ".btnArchivar", function(){
        let id = $(this).val();
        $.post(base_url + "caso/archivar/" + id,
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                if(result[1]){
                    $(".toast-body").html("El caso se ha archivado con éxito.");
                    $(".toast").toast({ autohide: false });
                    $(".toast").toast("show");               
                    $(".tbody").empty();
                    listado_casos();
                } else {
                    $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                    $(".toast").toast("show");
                }
            } else {
                window.location.replace(result[1]);
            }
        });
    });

    listado_casos();

});