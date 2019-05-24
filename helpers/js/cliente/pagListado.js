$(function(){

    function listado_clientes(){
        $.post(base_url + "cliente/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let clients = result[1];
                let table_content = "";
                for (let i = 0; i < clients.length; i++) {
                    table_content += `
                        <tr>
                            <th scope="row">`+ clients[i]["id"] +`</th>
                            <td>`+ clients[i]["name"] +` `+ clients[i]["lastname"] +`</td>
                            <td>`+ clients[i]["phone"] +`</td>
                            <td>`+ clients[i]["date"] +`</td>
                            <td>
                                <a href="`+base_url+`cliente/editar/`+ clients[i]["id"] +`" class="btn btn-outline-secondary btn-sm">Editar</a> 
                                <button value="`+ clients[i]["id"] +`" class="btn btn-outline-danger btn-sm btnEliminar">Eliminar</button>
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

    $(".table").on("click", ".btnEliminar", function(){
        let id = $(this).val();
        $.post(base_url + "cliente/eliminar/" + id,
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                if(result[1]){
                    $(".toast-body").html("El cliente se ha eliminado con éxito.");
                    $(".toast").toast("show");
                    $(".tbody").empty();
                    listado_clientes();
                } else {
                    $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                    $(".toast").toast("show");
                }
            } else {
                window.location.replace(result[1]);
            }
        });
    });

    listado_clientes();
 
});