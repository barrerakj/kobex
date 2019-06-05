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

    }

    listado_clientes();

});