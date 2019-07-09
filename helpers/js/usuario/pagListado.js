$(function(){

    var users = [];

    function listado_usuarios(){
        $.post(base_url + "usuario/listar",
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                users = result[1];
                let table_content = "";
                for (let i = 0; i < users.length; i++) {
                    table_content += `
                        <tr>
                            <th scope="row">`+ users[i]["id"] +`</th>
                            <td>`+ users[i]["name"] +` `+ users[i]["lastname"] +`</td>
                            <td>`+ users[i]["date"] +`</td>
                            <td>`+ users[i]["phone"] +`</td>
                            <td>`+ users[i]["email"] +`</td>
                            <td>
                                <button class="btn btn-sm btn-outline-info">Mensaje</button>
                                <button value="`+ users[i]["id"] +`" type="button" class="btn btn-sm btn-outline-danger btnDesasociar">Quitar de mi lista</button>
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
    }

    $(".table").on("click", ".btnDesasociar", function(){
        let i = $(this).parent().parent().index();
        let id = $(this).val();
        let nombre = users[i]["name"] + " " + users[i]["lastname"];

        $.post(base_url + "usuario/desasociar/" + id,
        {
            _token: token
        },
        function(data){
            let result = JSON.parse(data);
            if(result[0]){
                if(result[1]){
                    $(".toast-body").html("El usuario asociado: " + nombre + " ya no esta vinculado a su cuenta.");
                    $(".toast").toast("show");
                    $(".tbody").empty();
                    listado_usuarios();
                } else {
                    $(".toast-body").html("Se ha experimentado un error. Por favor contacte al administrador o intente de nuevo más tarde.");
                    $(".toast").toast("show");
                }
            } else {
                window.location.replace(result[1]);
            }
        });
    });

    listado_usuarios();
});