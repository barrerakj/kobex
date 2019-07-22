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
                let select_content = "";
                for (let i = 0; i < clients.length; i++) {
                    select_content += `<option value="`+ clients[i]["id"] +`">`+ clients[i]["name"] +` `+ clients[i]["lastname"] +`</option>`;
                    
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

    function listado_colaboradores(){
        $.post(base_url + "usuario/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                var users = result[1];
                var roles = [];
                //Get roles information
                $.post(base_url + "rol/listado",
                {
                    _token: token
                },
                function(data){
                    let result = JSON.parse(data);
                    if(result[0]){
                        roles = result[1];

                        let table_content = "";
                        for (let i = 0; i < users.length; i++) {
                            table_content += `
                                <tr>
                                    <td>`+ users[i]["name"] +` `+ users[i]["lastname"] +`</td>
                                    <td>`+ users[i]["phone"] +`</td>
                                    <td>`+ users[i]["email"] +`</td>
                                    <td>
                                        <select class="form-control">`;
                                            for (let j = 0; j < roles.length; j++) {
                                                table_content += '<option value="'+ users[i]["id"] +'">'+ roles[j]['name'] + '-' + roles[j]['description'] +'</option>'                                        
                                            }
                    table_content += ` </select>
                                    </td>
                                </tr>`;  
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

    listado_clientes();
    listado_colaboradores();

});