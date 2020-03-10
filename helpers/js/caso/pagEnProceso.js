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
                                <div class="dropdown">
                                    <button class="btn btn-outline-secondary far fa-edit dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="`+base_url+`caso/detalle/`+ cases[i]["id"] +`">Ver</a>
                                        <a class="dropdown-item" href="`+base_url+`caso/editar/`+ cases[i]["id"] +`">Editar</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="`+base_url+`doc/nuevo/`+ cases[i]["id"] +`">Agregar Documento</a>
                                        <a class="dropdown-item" href="#">Agregar Comentario</a>
                                        <div class="dropdown-divider"></div>
                                        <button value="`+ cases[i]["id"] +`" class="dropdown-item btnArchivar">Archivar</button>
                                    </div>
                                </div>
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