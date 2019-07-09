$(function(){

    $.post(base_url + "usuario/listar_bitacora",
    {
        _token: token
    },
    function(data){
        let result = JSON.parse(data);
        if(result[0]){
            let sessions = result[1];
            let table_content = "";
            for (let i = 0; i < sessions.length; i++) {
                table_content += `
                    <tr>
                        <th scope="row">`+ sessions[i]["id"] +`</th>
                        <td>`+ sessions[i]["name"] +` `+ sessions[i]["lastname"] +`</td>
                        <td>`+ sessions[i]["action"] +`</td>
                        <td>`+ sessions[i]["access"] +`</td>
                        <td>`+ sessions[i]["phone"] +`</td>
                        <td>`+ sessions[i]["email"] +`</td>
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

});