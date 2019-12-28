$(function(){

    function listado_casos(){
        $.post(base_url + "casos/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                let cases = result[1];
                let table_content = "";
                for (let i = 0; i < cases.length; i++) {
                    //Crear string con nombres de clientes
                    table_content += `
                        <tr>
                            <th scope="row">`+ cases[i]["id"] +`</th>
                            <td>`+ cases[i]["name"] +` `+ clients[i]["lastname"] +`</td>
                            <td>`+ cases[i]["clients"] +`</td>
                            <td>`+ cases[i]["description"] +`</td>
                            <td>`+ cases[i]["users"] +`</td>
                            <td>`+ cases[i]["date"] +`</td>
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

    listado_casos();

});